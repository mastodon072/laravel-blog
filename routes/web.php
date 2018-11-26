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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}',[ 'as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::post('/comment/add',[ 'as' => 'post.comment', 'uses' => 'PostCommentsController@add']);

Route::post('/reply/add',[ 'as' => 'comment.reply', 'uses' => 'CommentRepliesController@add']);

Route::delete('admin/media/delete','AdminMediasController@deleteMedia');

Route::group(['middleware' => 'admin'], function(){

    Route::get('/admin','AdminController@index');

    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/medias', 'AdminMediasController');
    Route::resource('admin/comments', 'PostCommentsController');
    Route::resource('admin/comment/replies', 'CommentRepliesController');
});