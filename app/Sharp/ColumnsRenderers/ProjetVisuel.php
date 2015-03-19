<?php namespace Idee\Sharp\ColumnsRenderers;

use Dvlpp\Sharp\ListView\Renderers\SharpRenderer;
use HTML;

class ProjetVisuel implements SharpRenderer {

    /**
     * @param $instance
     * @param $key
     * @param $options
     * @return string
     */
    function render($instance, $key, $options)
    {
        if($instance->visuel)
        {
            $w = 200;
            $h = 120;
            return HTML::image(vignette($instance->visuel, $w, $h), "", ["class"=>"img-responsive"]);
        }

        return null;
    }
}