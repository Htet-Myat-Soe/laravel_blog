<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class,"index"]);
Route::get('/articles', [ArticleController::class,"index"])->name("articles.index");
Route::get('/articles/details/{id}',[ArticleController::class,"details"])->name("articles.details");
Route::get('/articles/delete/{id}',[ArticleController::class,"delete"])->name("articles.delete");
Route::get('/articles/add',[ArticleController::class,"add"])->name("articles.add");
Route::post('/articles/add',[ArticleController::class,"create"])->name("articles.create");

Route::post("/comment/add",[CommentController::class,"add_cmt"])->name("article.add-cmt");
Route::get("/comment/delete/{id}",[CommentController::class,"delete"])->name("comment.delete");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
