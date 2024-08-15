<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    use HttpResponses;
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date_format:Y-m-d',
            'password' => 'required|string|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->httpSuccess([
            'message' => 'Registered suuccessfully',
            'user' => $user->only(['id', 'name', 'email']),
            'token' => $user->createToken('Token of ' . $user->name)->plainTextToken
        ]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        if (!auth()->attempt($request->toArray())) {
            return $this->httpFaliure('', 'Wrong email or password', 401);
        }

        $user = User::select('id', 'email', 'name')->where('email', $request->email)->first();
        return $this->httpSuccess([
            'message' => 'Logged in suuccessfully',
            'user' => $user->only(['id', 'name', 'email']),
            'token' => $user->createToken('Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->httpSuccess([
            'message' => 'Logged out suuccessfully'
        ]);
    }
}
