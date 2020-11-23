<?php

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * TODO to remove on larvavel upgrade
 * mix polyfill
 */
function mix($path, $manifestDirectory = '')
{
    static $manifests = [];
    if (! Str::startsWith($path, '/')) {
        $path = "/{$path}";
    }

    if ($manifestDirectory && ! Str::startsWith($manifestDirectory, '/')) {
        $manifestDirectory = "/{$manifestDirectory}";
    }

    if (file_exists(public_path($manifestDirectory.'/hot'))) {
        $url = rtrim(file_get_contents(public_path($manifestDirectory.'/hot')));

        if (Str::startsWith($url, ['http://', 'https://'])) {
            return new HtmlString((array_reverse(explode(':', $url, 2))[0]).$path);
        }

        return new HtmlString("//localhost:8080{$path}");
    }

    $manifestPath = public_path($manifestDirectory.'/mix-manifest.json');

    if (! isset($manifests[$manifestPath])) {
        if (! file_exists($manifestPath)) {
            throw new Exception('The Mix manifest does not exist.');
        }

        $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
    }

    $manifest = $manifests[$manifestPath];

    if (! isset($manifest[$path])) {
        $exception = new Exception("Unable to locate Mix file: {$path}.");

        throw $exception;
    }

    return new HtmlString(app('config')->get('app.mix_url').$manifestDirectory.$manifest[$path]);
}

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
