<?php

Route::get('/', 'HomeController@index');

Route::get('/projet/{id}/{slug?}', 'HomeController@projet');

Route::get('/page/{id}', 'HomeController@page');

Route::get('/dl/{projetFichierId}/{nom}/{fichier}', [
    'as' => 'dl',
    'uses' => 'HomeController@dl'
]);
