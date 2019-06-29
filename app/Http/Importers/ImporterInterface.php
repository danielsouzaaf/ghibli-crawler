<?php


namespace GhibliCrawler\Http\Importers;


interface ImporterInterface
{
    public function import($data);
}