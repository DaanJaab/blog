<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnAccountsController;
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

Route::resource('account', OwnAccountsController::class)->except(['show', 'create', 'store']);

Route::group(['prefix' => 'users'], function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/{user}', 'show')->name('users.show');
        Route::get('/{user}/posts', 'showUserPosts')->name('users.posts.index');
        Route::get('/{user}/comments', 'showUserComments')->name('users.comments.index');
    });
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [BlogsController::class, 'index'])->name('blog.index');
    Route::get('/{category}', [BlogsController::class, 'show'])->name('blog.show');
    Route::get('/{category}/create', [PostsController::class, 'createWithSpecificCategory'])->name('blog.posts.create');
    Route::post('/{category}', [PostsController::class, 'store'])->name('blog.posts.store');
});

Route::resource('/posts', PostsController::class);
Route::resource('posts.comments', CommentsController::class, [
    'except' => ['create']
]);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
