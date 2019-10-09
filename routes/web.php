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
    return view('dashboard');
});

//Resource members
Route::group(['prefix' => 'members'], function () {
    Route::get('list', 'MembersController@index')->name(MEMBER_LIST);
    Route::get('create', 'MembersController@create')->name(MEMBER_CREATE);
    Route::post('store', 'MembersController@store')->name(MEMBER_STORE);
    Route::get('edit/{id}', 'MembersController@edit')->name(MEMBER_EDIT);
    Route::post('update/{id}', 'MembersController@update')->name(MEMBER_UPDATE);
    Route::get('detail', 'MembersController@detail')->name(MEMBER_DETAIL);
    Route::post('delete', 'MembersController@delete')->name(MEMBER_DELETE);
});

//Resource divisions
Route::group(['prefix' => 'divisions'], function () {
    Route::get('list', 'DivisionsController@index')->name(DIVISION_LIST);
    Route::post('delete', 'DivisionsController@delete')->name(DIVISION_DELETE);
    Route::get('create', 'DivisionsController@create')->name(DIVISION_CREATE);
    Route::post('store', 'DivisionsController@store')->name(DIVISION_STORE);
    Route::get('edit/{id}', 'DivisionsController@edit')->name(DIVISION_EDIT);
    Route::post('update/{id}', 'DivisionsController@update')->name(DIVISION_UPDATE);
});

//Resource teams
Route::group(['prefix' => 'teams'],function () {
    Route::get('list', 'TeamsController@index')->name(TEAM_LIST);
    Route::get('create', 'TeamsController@create')->name(TEAM_CREATE);
    Route::post('store', 'TeamsController@store')->name(TEAM_STORE);
    Route::get('list-member','TeamsController@listMember');
});
