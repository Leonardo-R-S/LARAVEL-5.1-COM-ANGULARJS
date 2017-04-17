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

    return view('app');
});


Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

    //Indentifica automaticamente qual ação você quer tomar e direciona para o controller
    //Identifies what action and send to controller
    Route::resource('client', 'ClientController', ['except'=>['create','edit']]);



    //Incerts the value of prefix in rotas(Incere o valor do profixo nas rotas)
    Route::group(['prefix'=>'project'],function(){

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::delete('note/{noteId}', 'ProjectNoteController@destroy');

        Route::get('task', 'ProjectTaskController@index');
        Route::post('task', 'ProjectTaskController@store');
        Route::post('task/{id}', 'ProjectTaskController@update');
        Route::get('task/{id}', 'ProjectTaskController@show');
        Route::delete('task/{id}', 'ProjectTaskController@destroy');

        Route::get('{id}/members', 'ProjectController@showmembers');
        Route::post('{id}/members', 'ProjectController@storemembers');
        Route::delete('{id}/members/{memberId}', 'ProjectController@destroymembers');
        Route::get('{id}/members/{memberId}', 'ProjectController@isMember');


        Route::get('{id}/file', 'ProjectFileController@index');
        Route::get('{id}/file/{fileId}', 'ProjectFileController@show');
        Route::post('{id}/file/{fileId}', 'ProjectFileController@update');
        Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');


        Route::post('{id}/file', 'ProjectFileController@store');



       /* Route::get('{id}', 'ProjectController@show');
        Route::put('{id}', 'ProjectController@update');
        Route::delete('{id}', 'ProjectController@destroy');*/

    });

    Route::resource('project', 'ProjectController', ['except'=>['create','edit']]);



//Old code to exemple(codigo antigo para exemplo)
/*Route::get('project/{id}/note', 'ProjectNoteController@index');
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
Route::delete('project/{id}', 'ProjectController@destroy');*/






