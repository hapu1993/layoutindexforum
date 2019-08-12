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

// Route::get('/', function () {
//     return view('/');
// });

// Auther Amila

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/getdatafortag', 'PostController@getdatafortag')->name('getdatafortag');

Route::get('/search-result', 'SearchController@getData')->name('home');

// post resource
Route::resource('/posts', 'PostController');

Route::group(['middleware' => ['auth','role:admin']], function () {
Route::resource('user', 'UserController');
Route::post('users-all', 'UserController@getAll');
     
});