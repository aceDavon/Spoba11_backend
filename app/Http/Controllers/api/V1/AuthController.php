<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\V1\LoginRequest;
use App\Http\Requests\api\V1\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request)
    {
        $request->validated();

        if(!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error([], 'Credentials could not be verified', 401);
        }

        $user = User::where("email", $request->email)->first();

        return $this->success([
            "user" => $user,
            "token" => $user->createToken('API Token key for ' . $user->username)->plainTextToken],
            "Logged in successfully");
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());

        return $this->success([
            "user" => $user,
            "token" => $user->createToken('API Token key for ' . $user->username)->plainTextToken
        ], 'User created successfully');
    }
}
