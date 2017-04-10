<?php

namespace App\Http\Controllers\Tmdb;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Tmdb\Api\Genres;

class GenreController extends Controller
{
    /**
     * @var \Tmdb\Api\Genres
     */
    private $api;

    /**
     * Create a new controller instance.
     *
     * @param \Tmdb\Api\Genres $api
     */
    public function __construct(Genres $api)
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
        // returns a list of a genres
        return $this->api->getGenres();
    }

    /**
     * One movie
     *
     * @param  Request $request
     * @param          $id
     *
     * @return Response
     * @throws \HttpResponseException
     */
    public function show(Request $request, $id)
    {
        $item = $this->api->getGenre($id);

        if (!$item) {
            abort(404, "The genre $id is not found.");
        }

        // returns information of a genre
        return response($item);
    }

    /**
     * Movies of the genre given.
     *
     * @param  Request  $request
     * @param integer   $genre
     *
     * @return Response
     */
    public function movies(Request $request, $genre)
    {
        $page = $request->has('page') ? $request->get('page') : 1;

        /** @var  $item */
        $item = $this->api->getMovies($genre, ['page' => $page]);

        if (!$item) {
            abort(404, "The genre $genre is not found.");
        }

        // returns information of a genre
        return response($item);
    }
}
