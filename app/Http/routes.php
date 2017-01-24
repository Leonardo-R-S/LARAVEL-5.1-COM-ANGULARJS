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


Route::get('/', function () {

    return view('welcome');
});






Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::post('client/update/{id}', 'ClientController@update');
Route::get('client/{id}', 'ClientController@show');
Route::delete('client/{id}', 'ClientController@destroy');


Route::get('project/{id}/note', 'ProjectNoteController@index');
Route::post('project/{id}/note', 'ProjectNoteController@store');
Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');
Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
Route::post('project/{noteId}/note', 'ProjectNoteController@destroy');

Route::get('project/task', 'ProjectTaskController@index');
Route::post('project/task', 'ProjectTaskController@store');
Route::post('project/task/update/{id}', 'ProjectTaskController@update');
Route::get('project/task/{id}', 'ProjectTaskController@show');
Route::delete('project/task/{id}', 'ProjectTaskController@destroy');

Route::get('project/{id}/members', 'ProjectController@showmembers');
Route::post('project/{id}/members', 'ProjectController@storemembers');
Route::delete('project/{id}/members/{memberId}', 'ProjectController@destroymembers');
Route::get('project/{id}/members/{memberId}', 'ProjectController@isMember');


Route::get('project', 'ProjectController@index');
Route::post('project', 'ProjectController@store');
Route::post('project/update/{id}', 'ProjectController@update');
Route::get('project/{id}', 'ProjectController@show');
Route::delete('project/{id}', 'ProjectController@destroy');






