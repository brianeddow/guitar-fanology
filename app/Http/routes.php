<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    // Route::get('/', ['as' => 'index', function () {
    //     return view('welcome');
    // }]);
    Route::auth();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('', 'PagesController@index')->name('index');

    Route::get('guitars', 'PagesController@index')->name('guitars');
    Route::post('guitars/new', 'GuitarsController@create')->name('new');
    Route::get('guitars/{id}', 'GuitarsController@show')->name('show');
    Route::get('guitars/{id}/edit', 'GuitarsController@edit')->name('edit');
    Route::patch('guitars/{id}/update', 'GuitarsController@update')->name('update');
    Route::get('guitars/{id}/remove', 'GuitarsController@remove')->name('remove');
    Route::get('guitars/{id}/destroy', 'GuitarsController@destroy')->name('destroy');
    Route::get('guitars/{id}/like', 'GuitarsController@like')->name('like');
    Route::get('guitars/{id}/unlike', 'GuitarsController@unlike')->name('unlike');
    Route::post('guitars/{id}/edit', 'GuitarsController@request_edit')->name('request_edit');
    Route::get('guitars/{id}/like_note', 'GuitarsController@like_note')->name('like_note');

    Route::post('posts/{guitar_id}/new', 'PostsController@create')->name('create_post');
    Route::get('posts/{post_id}/delete', 'PostsController@delete')->name('delete_post');
    Route::post('comments/{post_id}/add', 'CommentsController@create')->name('add_comment');
    Route::get('comments/{comm_id}/delete', 'CommentsController@delete')->name('delete_comment');

});
