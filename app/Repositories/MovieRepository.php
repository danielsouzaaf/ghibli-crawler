<?php


namespace GhibliCrawler\Repositories;


use GhibliCrawler\Models\Movie;

class MovieRepository
{
    private $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function performUpdateOrCreate($data)
    {
        $this->movie->updateOrCreate([
            'id' => $data->id
        ], $data);
    }
}