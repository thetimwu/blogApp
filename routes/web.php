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
    //return view('welcome');
    return redirect('/blog');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/blog', 'BlogController@index')->middleware('auth');

Route::get('/searchByTitle', 'SearchController@searchByTitle')->middleware('auth');

Route::get('/sortByTitle', 'SearchController@sortPostsByTitle')->middleware('auth');

Route::get('/filterPosts', 'SearchController@filterPosts')->middleware('auth');
