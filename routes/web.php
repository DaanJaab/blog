<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
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

Route::controller(UsersController::class)->group(function () {
    Route::get('/account', 'index')->name('account.index');
    Route::get('/account/edit', 'edit')->name('account.edit');
    Route::put('/account', 'update')->name('account.update');
    Route::delete('/account', 'destroy')->name('account.destroy');

    Route::get('/users', 'showUsers')->name('users.index');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::get('/users/{user}/posts', 'showUserPosts')->name('users.posts.index');
    Route::get('/users/{user}/comments', 'showUserComments')->name('users.comments.index');
});

Route::get('/blog', [BlogsController::class, 'index'])->name('blog.index');
Route::get('/blog/{category}', [BlogsController::class, 'show'])->name('blog.show');
Route::get('/blog/{category}/create', [PostsController::class, 'createWithSpecificCategory'])->name('blog.posts.create');
Route::post('/blog/{category}', [PostsController::class, 'store'])->name('blog.posts.store');

Route::resource('/posts', PostsController::class);
Route::resource('posts.comments', CommentsController::class, [
    'except' => ['create']
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
