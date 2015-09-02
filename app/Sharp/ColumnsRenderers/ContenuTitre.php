<?php namespace Idee\Sharp\ColumnsRenderers;

use Dvlpp\Sharp\ListView\Renderers\SharpRenderer;

class ContenuTitre implements SharpRenderer {

    /**
     * @param $instance
     * @param $key
     * @param $options
     * @return string
     */
    function render($instance, $key, $options)
    {
        return '<strong>' . $instance->contenu->titre . '</strong>'
            . '<br/>' . $instance->contenu->chapo;
    }
}