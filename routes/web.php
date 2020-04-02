<?php

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

// All song button
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'Singer@index')->name('home');

// Add Singer button
Route::get('add_singer', 'Singer@add_singer')->name('add_singer');
// Add Singer page
Route::post('add_songType', 'Singer@add_songType')->name('add_songType');
Route::post('add_singer_now', 'Singer@add_singer_now')->name('add_singer_now');


// Add song page
Route::get('add_song', 'Singer@add_song')->name('add_song');
Route::post('add_song_now', 'Singer@add_song_now')->name('add_song_now');

// singer list page
Route::get('singerList', 'Singer@singerList')->name('singerList');


// Home page
Route::get('select_songType', 'Singer@select_songType');

Route::get('select_singerName', 'Singer@select_singerName');

Route::get('any_delete', 'Singer@any_delete');

// Any delete
Route::get('all_songType', 'Singer@all_songType');
Route::get('songType_delete/{songType_id}', 'Singer@songType_delete');

Route::get('all_singer', 'Singer@all_singer');
Route::get('singer_delete/{singer_id}', 'Singer@singer_delete');

Route::get('singerName', 'Singer@singerName');
Route::get('singerSongId_delete/{singerSongId}', 'Singer@singerSongId_delete');

Route::get('all_songs', 'Singer@all_songs');
Route::get('songId_delete/{song_id}', 'Singer@songId_delete');
