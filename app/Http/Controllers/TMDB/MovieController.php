<?php

namespace App\Http\Controllers\TMDB;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Tmdb\Api\Movies;

class MovieController extends Controller
{
    /**
     * @var \Tmdb\Api\Movies
     */
    private $api;

    /**
     * Create a new controller instance.
     *
     * @param \Tmdb\Api\Movies $api
     */
    public function __construct(Movies $api)
    {
        $this->middleware('auth');

        $this->api = $api;
    }

    /**
     * All movies
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->api->getPopular();
    }

    /**
     * One movie
     *
     * @param  Request  $request
     * @param $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // returns information of a movie
        return $this->api->getMovie($id);
    }
}
