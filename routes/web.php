<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;

//admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;


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

//CLIENT

Route::prefix('/')->group(function () {

    //page home
    Route::get('/', [IndexController::class, 'home'])->name('homepage');

    //page danh mục
    Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');

    //page thể loại
    Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');

    //page quốc gia
    Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');

    //page phim - chi tiết phim
    Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');

    //page xem phim
    Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watch');

    //page tập phim
    Route::get('/episode', [IndexController::class, 'episode'])->name('episode');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('homeadmin');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/search', [IndexController::class, 'search'])->name('search');

//Admin
Route::prefix('/')->group(function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/genre', GenreController::class);
    Route::resource('/country', CountryController::class);
    Route::resource('/episode', EpisodeController::class);
    Route::resource('/movie', MovieController::class);
});

Route::get('/update-year-movie', [MovieController::class, 'update_year']);
Route::get('/update-topview-movie', [MovieController::class, 'update_topview']);
Route::get('/filter-topview-movie', [MovieController::class, 'filter_topview']);
// Route::get('/filter-topview-default', [MovieController::class, 'filter_default']);

