<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AccountsController::class)->group(function () {
    Route::get('/account', 'index')->name('account.index');
    Route::get('/account/edit', 'edit')->name('account.edit');
    Route::put('/account', 'update')->name('account.update');
    Route::delete('/account', 'destroy')->name('account.destroy');

    Route::get('/users', 'usersIndex')->name('users.index');
    Route::get('/users/{user}', 'show')->name('users.show');
});
Route::get('/users/{user}/comments', [CommentsController::class, 'indexByUser'])->name('users.comments.index');
Route::resource('/posts', PostsController::class);
Route::resource('posts.comments', CommentsController::class, [
    'except' => ['create']
]);
Route::resource('/test', TestController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
