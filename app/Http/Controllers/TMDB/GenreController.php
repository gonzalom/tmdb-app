<?php

namespace App\Http\Controllers\TMDB;

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
            throw new NotFoundHttpException("The genre $id is not found.");
        }

        // returns information of a movie
        return response($this->api->getGenre($id));
    }
}
