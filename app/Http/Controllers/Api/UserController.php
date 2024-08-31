<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use HttpResponses;
    public function register(RegisterUserRequest $request)
    {

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


    public function login(LoginUserRequest $request)
    {
        $request->validated;

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
