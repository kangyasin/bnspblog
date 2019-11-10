<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
  // resouce = get index(), delete destroy(), put update(), post store()
  // Route::resource('/admin/article', 'ArticleController');

  Route::get('/admin/article', 'ArticleController@index');
  Route::post('/admin/article', 'ArticleController@store');
  Route::put('/admin/article/{id}', 'ArticleController@update');
  Route::delete('/admin/article/{id}', 'ArticleController@destroy');

  Route::get('/admin/add_article', 'ArticleController@add_article');
  Route::get('/admin/edit_article/{id}', 'ArticleController@edit_article');

  Route::get('/admin/insert_article', 'ArticleController@store');

  Route::get('/admin/product', 'ProductController@index');
  Route::post('/admin/product', 'ProductController@store');
  Route::put('/admin/product/{id}', 'ProductController@update');
  Route::delete('/admin/product/{id}', 'ProductController@destroy');
  Route::get('/admin/add_product', 'ProductController@add_product');
  Route::get('/admin/edit_product/{id}', 'ProductController@edit_product');
});
