<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\CommentsController;
use App\Http\Controllers\Auth\ReactionController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/addPost',[PostController::class,'postView'])->middleware(['auth'])->name('auth.addPost');
Route::post('/postAdd',[PostController::class,'postAdd'])->middleware(['auth'])->name('auth.postAdd');
Route::get('/userDashboard',[AuthenticatedSessionController::class,'userDashboard'])->middleware(['auth'])->name('auth.userDashboard');
Route::get('/addComment/{id}',[CommentsController::class,'addComment'])->middleware(['auth'])->name('auth.addComment');
Route::get('/notify/{id}',[ReactionController::class,'notifyUser'])->middleware(['auth'])->name('auth.notify');
Route::post('/comment/{id}',[CommentsController::class,'commentAdd'])->middleware(['auth'])->name('auth.commentAdd');
Route::post('/post',[ReactionController::class,'upVote'])->middleware(['auth'])->name('auth.likes');
Route::post('/postdislike',[ReactionController::class,'downVote'])->middleware(['auth'])->name('auth.dislike');

require __DIR__.'/auth.php';
