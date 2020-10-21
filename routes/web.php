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

Route::get('/', [PostController::class, 'index'])->name('timeline');
Route::get('/{post}', [PostController::class, 'show']);

Route::get('/{post}/comments', [CommentController::class, 'index']);
Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/activity/{user}', [UserController::class, 'show'])->name('activity');
