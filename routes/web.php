<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\BlogFrontendController;


Route::get('/', [BlogFrontendController::class, 'index'])->name('blog.index');
Route::get('/posts/{id}', [BlogFrontendController::class, 'show'])->name('blog.show');
Route::get('/create', [BlogFrontendController::class, 'create'])->name('blog.create');
Route::post('/create', [BlogFrontendController::class, 'store'])->name('blog.store');
Route::get('author/{id}', [BlogFrontendController::class, 'author'])->name('blog.author');


// Route::get('/', function () {
//     return view('welcome');
// });
