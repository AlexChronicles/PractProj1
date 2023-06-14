<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;
use App\Models\FavoriteMovie;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(10);
        return response()->json($movies);
        //return MovieResource::collection($movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }


    public function favorite(Request $request, $id){
        $userid = request('user');
        $movieid = request('movie_id');
        if (!(FavoriteMovie::where('userid', $userid)->where('movieid', $movieid)->exists())){
            $data = FavoriteMovie::create([
                'userid' => request('usid'),
                'movieid' => request('movie_id')
            ]);
            return response()->json($data,201);
        }
        return response('Record exists',500);
    }

    public function delfavorite(Request $request, $id){
        $userid = request('user');
        $movieid = request('movie_id');
        FavoriteMovie::where('userid', $userid)->where('movieid', $movieid)->delete();
        return response()->json('Succes',204);
    }

    public function indexunfavorite(Request $request, $id){
        $loaderType = request()->header('LoaderType');

        switch($loaderType){
            case 'sql':
                $movies = $this->getMoviesWithSql();
                break;
            return response()->json($movies);
        }
    }

    private function getMoviesWithSql(){
        $movies = Movie::whereNotIn('id', function ($query) use ($userid) {
            dd($userid);
            $query->select('movieid')
                ->from('favorite_movies')
                ->where('userid', $userid);
            })->get();
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
