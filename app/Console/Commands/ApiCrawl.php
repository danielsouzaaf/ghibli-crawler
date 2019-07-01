<?php

namespace GhibliCrawler\Console\Commands;

use GhibliCrawler\Http\Crawlers\CrawlerInterface;
use GhibliCrawler\Http\Crawlers\GhibliCrawler;
use GhibliCrawler\Importers\CharacterImporter;
use GhibliCrawler\Importers\MovieImporter;
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

    private $crawler;
    private $client;
    private $movieImporter;
    private $characterImporter;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client, MovieImporter $movieImporter, CharacterImporter $characterImporter)
    {
        $this->client = $client;
        $this->crawler = new GhibliCrawler($this->client);
        $this->movieImporter = $movieImporter;
        $this->characterImporter = $characterImporter;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        echo "\033[34m Rodando o comando\033[0m \n";

        $tempo_inicio = new \DateTime(date("H:i:s"));

        $moviesData = $this->crawler->crawl('https://ghibliapi.herokuapp.com/films');
        $charactersData = $this->crawler->crawl('https://ghibliapi.herokuapp.com/people');

        $this->movieImporter->import($moviesData);
        $this->characterImporter->import($charactersData);

        $tempo_rodando = (new \DateTime(date("H:i:s")))->diff($tempo_inicio)->format('%H:%I:%S');

        echo "\033[34m OK!\033[0m \n";
        echo "\033[34m Tempo rodando: {$tempo_rodando} \033[0m";
    }
}
