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

Route::get('/', 'PagesController@index');
Route::get('/about', function () {
    return view('blog.about');
});
Route::get('/contact', function () {
    return view('blog.contact');
});
Route::post('/contact', 'PagesController@contactForm');
Route::get('/posts/{id}', 'PostsController@single');
Route::post('/posts/{id}', 'PostsController@insertComment');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('admin/posts');
    });

    Route::get('/posts', 'PostsController@index');
    Route::post('/posts/{id}/delete', 'PostsController@delete');
    Route::get('/posts/{id}', 'PostsController@edit');
    Route::post('/posts/{id}/update', 'PostsController@update');

    Route::get('/comments', 'CommentsController@index');
    Route::post('/comments/{id}/delete', 'CommentsController@delete');

    Route::get('/users', 'UsersController@index');
    Route::post('/users/{id}/delete', 'UsersController@delete');
});

Auth::routes();
