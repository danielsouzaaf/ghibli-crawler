<?php


namespace GhibliCrawler\Http\Crawlers;


use GuzzleHttp\Client;

class GhibliCrawler implements CrawlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function crawl($url)
    {
        $request = $this->client->get($url);

        return json_decode($request->getBody()->getContents(), true);
    }
}