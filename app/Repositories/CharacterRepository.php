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
        $movies = $movieRepository->whereInUrls($data['films'])->pluck('id');

        $this->attachRelatedMovies($data['id'], $movies);
    }

    private function attachRelatedMovies($id, $moviesId)
    {
        $this->findById($id)->movies()->attach($moviesId);
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


}