<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/', [PostController::class, 'index'])->name('posts');
Route::get('/{post}', [PostController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::put('/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('can:update,post');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('can:delete,post');

    Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update')->middleware('can:update,comment');
    Route::delete('/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('can:delete,comment');
});

Route::get('/activity/{user}', [UserController::class, 'show'])->name('activity');
