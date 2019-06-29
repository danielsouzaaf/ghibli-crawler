<?php


namespace GhibliCrawler\Http\Crawlers;


use GuzzleHttp\Client;

class PeopleCrawler implements CrawlerInterface
{
    private $url;
    private $client;

    public function __construct(string $url, Client $client)
    {
        $this->url = $url;
        $this->client = $client;
    }

    public function crawl()
    {

        $request = $this->client->get($this->url);

        return $request->getBody()->getContents();
    }
}