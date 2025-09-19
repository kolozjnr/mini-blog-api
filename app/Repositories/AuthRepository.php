<?php

namespace App\Repositories;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\IAuthRepository;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthRepository implements IAuthRepository
{
    public function register(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        $token = JWTAuth::fromUser($user);

        return compact('user', 'token');
    }

    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return null;
        }
        return $token;
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }

    public function refresh()
    {
        return JWTAuth::refresh(JWTAuth::getToken());
    }

    public function user()
    {
        return auth()->user();
    }
}
