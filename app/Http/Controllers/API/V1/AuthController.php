<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\IAuthRepository;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $result = $this->authRepository->register($data);

        //dd($result);

        return response()->json([
            'user'  => $result['user'],
            'token' => $result['token']
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $token = $this->authRepository->login($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        $this->authRepository->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = $this->authRepository->refresh();
        return $this->respondWithToken($token);
    }

    public function user()
    {
        return response()->json($this->authRepository->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
