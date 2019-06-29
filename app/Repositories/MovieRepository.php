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

    public function findByUrl($url)
    {
        return Movie::where('url', $url)->first();
    }

    public function whereInUrls($urls)
    {
        return Movie::whereIn('url', $urls)->get();
    }
}