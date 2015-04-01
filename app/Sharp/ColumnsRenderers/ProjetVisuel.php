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
        if(!$instance->is_mode_actu && $instance->visuel)
        {
            $w = 200;
            $h = 120;
            return HTML::image(vignette($instance->visuel, $w, $h), "", ["class"=>"img-responsive"]);
        }
        elseif($instance->is_mode_actu)
        {
            return "<p><small><em>" . str_limit($instance->texte_actu, 80) . "</em></small></p>";
        }

        return null;
    }
}