<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//CRUD PRODUCTOS
Route::GET('/products/{id?}', 'API\ProductController@index')->where(['id','[0-9]+']);
Route::POST('/products', 'API\ProductController@create');
Route::PUT('/products/{id}', 'API\ProductController@update')->where(['id','[0-9]+']);
Route::DELETE('/products/{id}', 'API\ProductController@delete')->where(['id','[0-9]+']);

//CRUD USUARIOS
Route::GET('/users/{id?}', 'API\UserController@index')->where(['id','[0-9]+']);
Route::POST('/users', 'API\UserController@create');
Route::PUT('/users/{id}', 'API\UserController@update')->where(['id','[0-9]+']);
Route::DELETE('/users/{id}', 'API\UserController@delete')->where(['id','[0-9]+']);

//CRUD COMENTARIOS
Route::GET('/comments/{id?}', 'API\CommentController@index')->where(['id','[0-9]+']);
Route::POST('/comments', 'API\CommentController@create');
Route::PUT('/comments/{id}', 'API\CommentController@update')->where(['id','[0-9]+']);
Route::DELETE('/comments/{id}', 'API\CommentController@delete')->where(['id','[0-9]+']);

//CONSULTAS AVANZADAS
//buscar comentarios de un mismo usuario
Route::GET('/queryUser/{user}','API\CommentController@queryUser');
//buscar comentarios de un mismo producto
Route::GET('/queryProduct/{product}', 'API\CommentController@queryProduct');