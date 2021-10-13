<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('getArticles', [ArticleController::class, 'getArticles']);
Route::get('getTags', [ArticleController::class, 'getTags']);

Route::get('getArticleInfo/{article}', [ArticleController::class, 'getArticleInfo']);

Route::post('createArticle', [ArticleController::class, 'store']);
Route::post('postComment', [ArticleController::class, 'postComment']);
Route::post('postReply', [ArticleController::class, 'postReply']);

Route::post("register", [LoginController::class, 'register']);
Route::post("login", [LoginController::class, 'login']);
Route::delete("logout", [LoginController::class, "logout"]);
route::get("me", [LoginController::class, "me"]);

route::get("sanctum", function() {
    dd(Auth::user());
});



