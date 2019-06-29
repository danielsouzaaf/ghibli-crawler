<?php

namespace GhibliCrawler\Http\Controllers;

use GhibliCrawler\Presenters\CharacterPresenter;
use GhibliCrawler\Repositories\CharacterRepository;
use GhibliCrawler\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CharacterController extends Controller
{
    private $characterRepository;
    private $movieRepository;
    private $presenter;

    public function __construct(CharacterRepository $characterRepository, MovieRepository $movieRepository, CharacterPresenter $presenter)
    {
        $this->characterRepository = $characterRepository;
        $this->movieRepository = $movieRepository;
        $this->presenter = $presenter;
    }

    public function results(Request $request)
    {
        $characters = $this->characterRepository->allWithMovies();

        return $this->presenter->present($characters, CharacterPresenter::FORMATS_ARRAY[$request->input('fmt')]);
    }
}
