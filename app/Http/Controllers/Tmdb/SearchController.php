<?php

namespace App\Http\Controllers\Tmdb;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Tmdb\Api\Search;

class SearchController extends Controller
{
    /**
     * @var \Tmdb\Api\Search
     */
    private $api;

    /**
     * Create a new controller instance.
     *
     * @param \Tmdb\Api\Search $api
     */
    public function __construct(Search $api)
    {
        $this->middleware('auth');

        $this->api = $api;
    }

    /**
     * Movies of the genre given.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function movies(Request $request)
    {
        $query = $request->has('query') ? $request->get('query') : '';
        $page = $request->has('page') ? $request->get('page') : 1;

        /** @var  $item */
        $item = $this->api->searchMovies($query, ['page' => $page]);

        if (!$item) {
            abort(404, "The genre $query is not found.");
        }

        // returns information of a genre
        return response($item);
    }
}
