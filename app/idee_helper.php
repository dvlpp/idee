<?php

use Intervention\Image\Facades\Image;

function vignette($upload, $largeur, $hauteur=null, $options=[])
{
    if($upload) return sharp_thumbnail($upload->getSharpFilePath(), $largeur, $hauteur, $options);

    return "";
}

function vignetteNB($upload, $largeur, $hauteur=null, $options=[])
{
//    return vignette($upload, $largeur, $hauteur, $options);
    $vignette = vignette($upload, $largeur, $hauteur, $options);

    if($vignette)
    {
        $file = public_path(substr($vignette, strlen(config("app.url"))));

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

function markdown($text, $couleurLiens=null)
{
    $html = sharp_markdown($text);

    if($couleurLiens)
    {
        $html = preg_replace('#<(a\s[^>]*)>#', '<$1 style="color:#'.$couleurLiens.'">', $html);
    }

    return $html;
}
