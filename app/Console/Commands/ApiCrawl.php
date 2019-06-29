<?php

namespace GhibliCrawler\Console\Commands;

use GhibliCrawler\Http\Crawlers\CrawlerInterface;
use GhibliCrawler\Http\Crawlers\PeopleCrawler;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ApiCrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obter e armazenar as informações da API do Studio Ghibli.';

    private $peopleCrawler;
    private $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->peopleCrawler = new PeopleCrawler('https://ghibliapi.herokuapp.com/people', $this->client);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        var_dump($this->peopleCrawler->crawl());
    }
}
