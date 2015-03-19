<?php

use Intervention\Image\Facades\Image;

Route::get('/', 'HomeController@index');

Route::get('/projet/{id}/{slug?}', 'HomeController@projet');

Route::get('/page/{id}', 'HomeController@page');

Route::get("/test", function() {

    $upload = \Idee\Core\Upload::find(1);

//    dd(sharp_thumbnail($upload->getSharpFilePath(), 100, 100));

    $file = $upload->getSharpFilePath();

    $img = Image::make($file);
    $img->colorize(-100, 0, 100);
//    $img->colorize(100, 0, -100);

    $response = Response::make($img->encode('jpg'));
    $response->header('Content-Type', 'image/jpeg');
    return $response;

});

Route::get("/test2", function() {

    $upload = \Idee\Core\Upload::find(1);

//    dd(sharp_thumbnail($upload->getSharpFilePath(), 100, 100));

    $file = $upload->getSharpFilePath();

    $img = Image::make($file);
    $img->greyscale();
    $img->gamma(2);

    $response = Response::make($img->encode('jpg'));
    $response->header('Content-Type', 'image/jpeg');
    return $response;

});
