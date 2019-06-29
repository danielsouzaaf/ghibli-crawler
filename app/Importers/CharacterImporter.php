<?php


namespace GhibliCrawler\Importers;


use GhibliCrawler\Repositories\CharacterRepository;
use GhibliCrawler\Repositories\MovieRepository;
use Illuminate\Support\Collection;

class CharacterImporter implements ImporterInterface
{

    private $charactersRepository;
    private $moviesRepository;

    public function __construct(CharacterRepository $charactersRepository, MovieRepository $moviesRepository)
    {
        $this->charactersRepository = $charactersRepository;
        $this->moviesRepository= $moviesRepository;
    }


    public function import(Collection $characterData)
    {
        $characterData->each(function($character) {
            $this->charactersRepository->updateOrCreateWithMovies($character, $this->moviesRepository);
        });
    }
}