<?php

namespace App\Http\Controllers;


use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function save(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return 'Success';
    }

    public function login()
    {
        $credentials = request(['email', 'password']);


        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        //return User::all('name');
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
//        if (Auth::user()->role->id)

        $user = User::find(auth()->id());
        $user->role_id;
        if ($user->role_id == 1) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'name' => $user->name,
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        } else {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'user',
                'name' => $user->name,
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }

    }
}
