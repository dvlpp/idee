<?php

Route::get('/', 'HomeController@index');

Route::get('/projet/{id}/{slug?}', 'HomeController@projet');

Route::get('/page/{id}', 'HomeController@page');

Route::get('/pdf/{idprojet}/{nom}/{fichier}', [
    'as' => 'pdf',
    'uses' => 'HomeController@pdf'
]);
