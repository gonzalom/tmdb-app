<?php

namespace App\Http\Controllers\Tmdb;

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
        // returns a list of a movies
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
        $item = $this->api->getMovie($id);

        if (!$item) {
            abort(404, "The movie $id is not found.");
        }

        // returns information of a movie
        return response($item);
    }
}
