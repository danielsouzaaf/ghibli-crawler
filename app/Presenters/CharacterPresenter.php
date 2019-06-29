<?php


namespace GhibliCrawler\Presenters;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class CharacterPresenter
{
    const FORMAT_CSV = 'csv';
    const FORMAT_JSON = 'json';
    const FORMAT_HTML = 'html';

    const FORMATS_ARRAY = [
        self::FORMAT_JSON => self::FORMAT_JSON,
        self::FORMAT_CSV => self::FORMAT_CSV,
        self::FORMAT_HTML => self::FORMAT_HTML,
    ];

    public function present(Collection $characters, $format)
    {
        $mapped = $characters->map(function($character) {
            return [
                'nome' => $character->name,
                'idade' => $character->age,
                'filmes' => $character->movies->map(function ($movie) {
                    return [
                        'titulo' => $movie->title,
                        'ano_lancamento' => $movie->release_date,
                        'pontuacao_rotten_tomatoes' => $movie->rt_score
                    ];
                })
            ];
        })->toArray();

        return $this->output($mapped, $format);
    }

    private function output($mapped, $format)
    {
        if ($format == self::FORMAT_JSON)
            return $this->outputAsJson($mapped);
        else if ($format == self::FORMAT_CSV)
            return $this->outputAsCsv($mapped);
        return $this->outputAsHtml($mapped);
    }

    private function outputAsCsv($mapped)
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=personagens.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $callback = function() use ($mapped)
        {
            $FH = fopen('php://output', 'w');
            foreach ($mapped as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::streamDownload($callback, 'personagens.csv', $headers);
    }

    private function outputAsJson($mapped)
    {
        return Response::json($mapped);
    }

    private function outputAsHtml($mapped)
    {
        return View::make('characters.table', [
            'mapped' => $mapped,
        ]);
        //TODO: Implementar HTML
    }

}