<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;



class UserController extends Controller
{

    public function index()
    {
        return UserResource::collection(User::all());
    }

    //Можно добавить Request Валидацию
    public function create(Request $request)
    {
        $data = User::create(request()->all())->save();
        return response()->json($data,201);
    }

    public function show(Request $request,$id)
    {
        $user = User::find($id);
        if ($user)
            return new UserResource($user);
        return response()->json('Uncurrent user',422);
    }

    //Можно добавить Request Валидацию
    public function update(Request $request, $id)
    {
        if (!$id !== auth('sanctum')->user()->id)
            return response()->json('Uncurrent user',422);
        $user = User::find($id);
        $user?->fill(request()->only('name', 'username'))->save();
        return response()->json(['data' => new UserResource($user)], 200);
    }

    public function destroy($id)
    {
        if ($id !== auth('sanctum')->user()->id)
            return response()->json('Uncurrent user',422);
        $user = User::find($id);
        if (!$user) {
            return response()->json('Not found', 404);
        }
        $user->delete();
        return response()->json('Succes',204);
    }
}
