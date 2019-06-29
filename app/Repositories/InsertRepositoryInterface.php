<?php


namespace GhibliCrawler\Repositories;


interface InsertRepositoryInterface
{
    public function performUpdateOrCreate($data);
}