<?php

namespace App\Repositories;

interface IAuthRepository
{
    public function register(array $data);
    public function login(array $credentials);
    public function logout();
    public function refresh();
    public function user();
}
