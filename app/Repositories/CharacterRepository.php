<?php


namespace GhibliCrawler\Repositories;


use GhibliCrawler\Models\Character;

class CharacterRepository implements InsertRepositoryInterface
{
    const ORDER_NOME = 'nome';
    const ORDER_IDADE = 'idade';
    const ORDER_FILME_TITULO = 'filmes.titulo';
    const ORDER_FILME_ANO_LANCAMENTO = 'filmes.ano_lancamento';
    const ORDER_FILME_PONTUACAO_ROTTEN_TOMATOES = 'filmes.pontuacao_rotten_tomatoes';

    const MAPA_ORDER_CAMPOS = [
        self::ORDER_NOME => 'name',
        self::ORDER_IDADE => 'age',
        self::ORDER_FILME_TITULO => 'movies.title',
        self::ORDER_FILME_ANO_LANCAMENTO => 'movies.release_year',
        self::ORDER_FILME_PONTUACAO_ROTTEN_TOMATOES => 'movies.rt_score',
    ];

    public function performUpdateOrCreate($data)
    {
        Character::updateOrCreate([
            'id' => $data['id']
        ], $data);
    }

    public function updateOrCreateWithMovies($data, MovieRepository $movieRepository)
    {
        $this->performUpdateOrCreate($data);
        $movies = $movieRepository->whereInUrls($data['films'])->pluck('id');

        $this->attachRelatedMovies($data['id'], $movies);
    }

    private function attachRelatedMovies($id, $moviesId)
    {
        $this->findById($id)->movies()->syncWithoutDetaching($moviesId);
    }

    public function findById($id)
    {
        return Character::find($id);
    }

    public function all()
    {
        return Character::all();
    }

    public function allWithMovies()
    {
        return Character::with('movies')->get();
    }

    public function filteredOrderedAndSortedWithMovies($filter, $order = null, $sort = null)
    {
        $query = Character::with('movies');
        if ($filter)
            $query->where('name', 'ilike', "%{$filter}%")
                ->orWhere('age', 'ilike', "%{$filter}%")
                ->orWhereHas('movies', function ($query) use ($filter) {
                    return $query->where('title', 'ilike', "%{$filter}%")
                        ->orWhere('rt_score', 'ilike', "%{$filter}%");
        });
        if ($order)
            $query->orderBy(self::MAPA_ORDER_CAMPOS[$order], $sort ? $sort : 'asc');

        return $query->get();
    }


}