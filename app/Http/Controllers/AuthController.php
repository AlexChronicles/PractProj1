<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;



class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return AuthResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Можно добавить Request Валидацию
    public function create(Request $request)
    {
        //User::find($id)!?->fill(request()->only('name', 'username','password','email'))->save();


        $data = User::create(request()->all())->save();
        //$data = fill(request()->all()) -> save();
        return response()->json($data,201);
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

    public function show(Request $request,$id)
    {

        if (request()->hasHeader('User-Id')){
            if (($User_Id = request()->header('User-Id')) == request('id')){
                return new AuthResource(User::find($id));
            }
            return response('Uncurrent user',401);
        }
        return response('Something going wrong',500);
        //return new AuthResource(User::find($id));
        //esle return messege('Uncurrent User');
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

    //Можно добавить Request Валидацию
    public function update(Request $request, $id)
    {
        /*$name = $request->input('name');
        $username = $request->input('username');

        User::find($id) ?-> fill(
            'name' => request('name'),
            'username' => request('username'),
        );*/
        if (request()->hasHeader('User-Id')){
            if (($User_Id = request()->header('User-Id')) == request('id')){
                User::find($id)?->fill(request()->only('name', 'username'))->save();
                return response()->json([
                'data' => new AuthResource(User::find($id))
                ], 200);
            }
            return response('Uncurrent user',401);
        }
        return response('Something going wrong',500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->hasHeader('User-Id')){
            if (($User_Id = request()->header('User-Id')) == request('id')){
                User::find($id)->delete();
                return response()->json('Succes',204);
                }
            return response('Uncurrent user',401);
        }
        return response('Something going wrong',500);
    }
}
