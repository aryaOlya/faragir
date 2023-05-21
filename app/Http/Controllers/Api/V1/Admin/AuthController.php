<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Models\User;
use App\Repositories\Mysql\User\UserRepository;

class AuthController extends ApiController
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userRepository->create(["name"=>$request->name,"password"=>$request->password]);
        $token = $user->createToken('myApp')->plainTextToken;

        return $this->success(201,["user"=>$user,"token"=>$token],'user created successfully!');
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()->where("name",$request->name)->first();

        if (!$user)
            return $this->error(401,[],"no user found!!");

        $token = $user->createToken('myApp')->plainTextToken;

        return $this->success(202,["user"=>$user,"token"=>$token],'user '.$user->name.' logged in successfully!');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success(202,[],'logged out successfully!');
    }
}
