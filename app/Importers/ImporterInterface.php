<?php


namespace GhibliCrawler\Importers;


use Illuminate\Support\Collection;

interface ImporterInterface
{
    public function import(Collection $data);
}