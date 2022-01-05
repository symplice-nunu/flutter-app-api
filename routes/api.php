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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'auth:api'], function() {
  
// });
Route::post('/register', 'Api\AuthController@register');
  Route::post('/login', 'Api\AuthController@login');
  Route::post('/logout', 'Api\AuthController@logout');

  Route::get('posts', 'Api\PostController@getAllPosts');
  Route::get('posts/{id}', 'Api\PostController@getPost');
  Route::post('posts', 'Api\PostController@createPost');
  Route::post('posts/{id}', 'Api\PostController@updatePost');
  Route::delete('posts/{id}','Api\PostController@deletePost');

  Route::get('postcategory', 'Api\PostcategoryController@getAllPostcategorys');
  Route::get('postcategory/{id}', 'Api\PostcategoryController@getPostcategory');
  Route::post('postcategory', 'Api\PostcategoryController@createPostcategory');
  Route::post('postcategory/{id}', 'Api\PostcategoryController@updatePostcategory');
  Route::delete('postcategory/{id}','Api\PostcategoryController@deletePostcategory');


