<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::controller(AccountController::class)->group(function () {
    Route::get('/account', 'index')->name('account.index');
    Route::get('/account/edit', 'edit')->name('account.edit');
    Route::put('/account', 'update')->name('account.update');
    Route::delete('/account', 'destroy')->name('account.destroy');
});
Route::resource('/blog', PostController::class);
Route::resource('/comment', CommentController::class, [
    'except' => ['create']
]);
Route::resource('/profile', ProfileController::class, [
    'only' => ['index', 'show']
]);
Route::get('/test/{key}', [TestController::class, 'show']);
Route::post('/blog/{slug}/save', [TestController::class, 'store'])->name('store-comment');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
