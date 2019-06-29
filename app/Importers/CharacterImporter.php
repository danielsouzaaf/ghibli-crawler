<?php


namespace GhibliCrawler\Importers;


use GhibliCrawler\Repositories\CharacterRepository;
use Illuminate\Support\Collection;

class CharacterImporter implements ImporterInterface
{

    private $charactersRepository;

    public function __construct(CharacterRepository $charactersRepository)
    {
        $this->charactersRepository = $charactersRepository;
    }


    public function import(Collection $characterData)
    {
        $characterData->each(function($character) {
            $this->charactersRepository->updateOrCreateWithMovies($character);
        });
    }
}