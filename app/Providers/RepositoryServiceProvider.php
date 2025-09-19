<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\PostRepository;
use App\Repositories\IAuthRepository;
use App\Repositories\IPostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
    }

    public function boot(): void
    {
        
    }
}