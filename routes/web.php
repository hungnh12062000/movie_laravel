<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;

//admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\DashboardController;


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

$admin = config('web_route.url.admin');

//------------------------------------------------------CLIENT------------------------------------------------------

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
    Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);

    //page tập phim
    Route::get('/episode-number', [IndexController::class, 'episode'])->name('episode-number');
});

Auth::routes();
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/search', [IndexController::class, 'search'])->name('search');



//------------------------------------------------------ADMIN------------------------------------------------------

Route::get('/update-year-movie', [MovieController::class, 'update_year']);
Route::get('/update-topview-movie', [MovieController::class, 'update_topview']);
// Route::get('/filter-topview-movie', [MovieController::class, 'filter_topview']);
// Route::get('/filter-topview-default', [MovieController::class, 'filter_default']);
Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');

Route::prefix($admin)->group(function () {

    //====================DASHBOARD========================
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //====================DANH MỤC=========================
    Route::resource('/category', CategoryController::class);

    //====================THỂ LOẠI=========================
    Route::resource('/genre', GenreController::class);

    //====================QUỐC GIA=========================
    Route::resource('/country', CountryController::class);

    //======================PHIM===========================
    Route::resource('/movie', MovieController::class);

    //====================TẬP PHIM=========================
    Route::resource('/episode', EpisodeController::class);

    //====================SLIDER===========================
    $slider  = 'slider';
    Route::prefix($slider)->group(function () {
        Route::get('/', [DashboardController::class, 'slider'])->name('slider');
    });
});
