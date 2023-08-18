<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;

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

Route::get('/', [IndexController::class, 'home']);
Route::get('/read/{id}', [IndexController::class, 'read'])->name('read');
Route::get('/novel-category/{slug}', [IndexController::class, 'novel_category'])->name('novel-category');
Route::get('/read-chapter/{slug}', [IndexController::class, 'read_chapter'])->name('read-chapter');
Route::get('/search', [IndexController::class, 'search'])->name('search');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/category', CategoryController::class);

Route::resource('/novel', NovelController::class);

Route::resource('/chapter', ChapterController::class);







