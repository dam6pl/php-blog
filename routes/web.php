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

Route::get('/', 'PageController@index');
Route::get('/about', function () {
    return view('blog.about');
});
Route::get('/contact', function () {
    return view('blog.contact');
});
Route::post('/contact', 'PageController@contactForm');
Route::get('/posts/{id}', 'PostController@single');
Route::post('/posts/{id}', 'PostController@insertComment');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('admin/posts');
    });

    Route::get('/posts', 'PageController@adminPosts');
    Route::post('/posts/{id}/delete', 'PostController@delete');
    Route::get('/posts/{id}', 'PostController@edit');
    Route::post('/posts/{id}/update', 'PostController@update');
});

Auth::routes();
