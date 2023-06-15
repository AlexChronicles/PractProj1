<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
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
        return response()->json($movies, 200);
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
        if ((FavoriteMovie::where('user_id', $userid)->where('movie_id', $movieid)->exists()))
            return response('Record exists',500);
        $data = FavoriteMovie::create([
            'user_id' => $userid,
            'movie_id' => $movieid
        ]);
        return response()->json($data,201);
    }

    public function delFavorite(Request $request, $id){
        $userid = request('user');
        $movieid = request('movie_id');
        if (!(FavoriteMovie::where('userid', $userid)->where('movieid', $movieid)->exists()))
            return response('Record is not exist',500);
        FavoriteMovie::where('user_id', $userid)->where('movie_id', $movieid)->delete();
        return response()->json('Succes',204);
    }

    public function indexUnFavorite(Request $request, $id){
        $loaderType = request()->header('LoaderType');

        switch($loaderType){
            case 'sql':
                $movies = $this->getMoviesWithSql();
                return response()->json($movies);
            case 'inMemory':
                $movies = $this->getMoviesInMemory();
                return response()->json($movies);
            return response()->json(['error' => 'INTERNAL_ERROR'], 500);
        }
    }

    private function getMoviesWithSql(){
        $userid = request('user');
        $movies = DB::select(DB::raw("Select * From movies where id not in (Select movie_id From favorite_movies Where user_id = '$userid')"));
        return $movies;
    }

    private function getMoviesInMemory(){
        $userid = request('user');
        $movies = Movie::whereNotIn('id', function ($query) use ($userid) {
            $query->select('movie_id')
                ->from('favorite_movies')
                ->where('user_id', $userid);
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
