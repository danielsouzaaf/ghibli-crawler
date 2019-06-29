<?php


namespace GhibliCrawler\Http\Importers;


use Illuminate\Database\Eloquent\Collection;

interface ImporterInterface
{
    public function import(Collection $data);
}