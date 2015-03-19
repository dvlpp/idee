<?php

use Intervention\Image\Facades\Image;

function vignette($upload, $largeur, $hauteur, $options=[])
{
    if($upload) return sharp_thumbnail($upload->getSharpFilePath(), $largeur, $hauteur, $options);

    return "";
}

function vignetteNB($upload, $largeur, $hauteur, $options=[])
{
    $vignette = vignette($upload, $largeur, $hauteur, $options);

    if($vignette)
    {
        $file = public_path(substr($vignette, strlen(Config::get("app.url"))));

        $fileName = $file . "_NB.jpg";

        if( ! file_exists($fileName))
        {
            $img = Image::make($file);
            $img->greyscale();
            $img->gamma(2);

            $img->save($file . "_NB.jpg");
        }

        $fileName = substr($fileName, strlen(public_path()));

        return url($fileName);
    }

    return "";
}

function markdown($text)
{
    return sharp_markdown($text);
}