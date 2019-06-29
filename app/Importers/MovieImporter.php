<?php


namespace GhibliCrawler\Importers;

use GhibliCrawler\Repositories\MovieRepository;
use Illuminate\Support\Collection;

class MovieImporter implements ImporterInterface
{
    private $moviesRepository;
    public function __construct(MovieRepository $movies)
    {
        $this->moviesRepository = $movies;
    }

    public function import(Collection $movieData)
    {
        $movieData->each(function($movie) {
            $this->moviesRepository->performUpdateOrCreate($movie);
        });

    }
}