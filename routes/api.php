<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::get('getArticleInfo/{article}', [ArticleController::class, 'getArticleInfo']);

Route::post('postComment', [ArticleController::class, 'postComment']);

Route::post('postReply', [ArticleController::class, 'postReply']);

Route::post("register", [LoginController::class, 'register']);
Route::post("login", [LoginController::class, 'login']);
Route::delete("logout", [LoginController::class, "logout"]);


