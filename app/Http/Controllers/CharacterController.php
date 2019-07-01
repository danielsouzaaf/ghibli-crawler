<?php

namespace GhibliCrawler\Http\Controllers;

use GhibliCrawler\Http\Requests\Character\ResultsRequest;
use GhibliCrawler\Presenters\CharacterPresenter;
use GhibliCrawler\Repositories\CharacterRepository;
use GhibliCrawler\Repositories\MovieRepository;

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

    public function results(ResultsRequest $request)
    {
        $characters = $this->characterRepository->filteredOrderedAndSortedWithMovies($request->input('filter'),
            $request->input('order'), $request->input('sort'));

        return $this->presenter->present($characters, CharacterPresenter::FORMATS_ARRAY[$request->input('fmt')]);
    }
}
