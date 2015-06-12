<?php

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

Route::get('/', 'HomeController@index');

Route::get('/projet/{id}/{slug?}', 'HomeController@projet');

Route::get('/page/{id}', 'HomeController@page');

Route::get('/dl/{projetFichierId}/{nom}/{fichier}', [
    'as' => 'dl',
    'uses' => 'HomeController@dl'
]);


Route::get("kroford", function() {
    if($_SERVER['REMOTE_ADDR'] != '109.221.44.199') throw new AccessDeniedHttpException;
    return '<!DOCTYPE html><html lang="fr"><head><meta charset="utf-8"></head><body style="background:#ddd"><div style="margin:80px auto; width:300px; background:#fff; padding:20px; font-size:18px; box-shadow: 0 0 5px #aaa">Rendez-vous Pl. de la République -- Prendre selfie avec monument aux mort et envoyer par SMS.</div></body></html>';
});

