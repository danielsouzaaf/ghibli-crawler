<?php

namespace GhibliCrawler\Http\Controllers;

use GhibliCrawler\Repositories\CharacterRepository;
use GhibliCrawler\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CharacterController extends Controller
{
    private $characterRepository;
    private $movieRepository;

    public function __construct(CharacterRepository $characterRepository, MovieRepository $movieRepository)
    {
        $this->characterRepository = $characterRepository;
        $this->movieRepository = $movieRepository;
    }

    public function results(Request $request)
    {
        $characters = $this->characterRepository->allWithMovies();

        return Response::json($characters);
    }
}
