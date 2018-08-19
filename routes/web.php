<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('phonebook', 'PhonebookController');
Route::post('getData', 'PhonebookController@getData');