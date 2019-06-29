<?php


namespace GhibliCrawler\Http\Importers;


use GhibliCrawler\Models\Movie;
use GhibliCrawler\Repositories\MovieRepository;
use Illuminate\Database\Eloquent\Collection;

class MovieImporter implements ImporterInterface
{
    private $moviesRepository;
    public function __construct()
    {
        $this->moviesRepository = new MovieRepository;
    }

    public function import(Collection $movieData)
    {

    }
}