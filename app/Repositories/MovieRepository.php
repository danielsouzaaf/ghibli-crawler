<?php


namespace GhibliCrawler\Repositories;


use GhibliCrawler\Models\Movie;

class MovieRepository implements InsertRepositoryInterface
{
    public function performUpdateOrCreate($data)
    {
        Movie::updateOrCreate([
            'id' => $data['id']
        ], $data);
    }

    public function findbyUrl($url)
    {
        return Movie::where('url', $url)->first();
    }
}