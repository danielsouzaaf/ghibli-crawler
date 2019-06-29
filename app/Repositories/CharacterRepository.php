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

    public function updateOrCreateWithMovies($data)
    {
        $this->performUpdateOrCreate($data);
    }


}