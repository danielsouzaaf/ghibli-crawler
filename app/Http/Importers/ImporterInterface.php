<?php


namespace GhibliCrawler\Http\Importers;


use Illuminate\Support\Collection;

interface ImporterInterface
{
    public function import(Collection $data);
}