<?php


namespace GhibliCrawler\Repositories;


use GhibliCrawler\Models\Character;

class CharacterRepository implements InsertRepositoryInterface
{
    public function performUpdateOrCreate($data)
    {
        Character::updateOrCreate([
            'id' => $data['id']
        ], $data);
    }

    public function updateOrCreateWithMovies($data, MovieRepository $movieRepository)
    {
        $this->performUpdateOrCreate($data);
        $movies = $movieRepository->whereInUrls($data['movies'])->pluck('id');

        $this->attachRelatedMovies($data['id'], $movies);
    }

    public function attachRelatedMovies($id, $moviesId)
    {
        $this->findById($id)->attach($moviesId);
    }

    public function findById($id)
    {
        return Character::find($id);
    }


}