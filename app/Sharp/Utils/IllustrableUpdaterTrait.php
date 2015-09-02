<?php namespace Idee\Sharp\Utils;

use Idee\Core\IllustrableVisuel;

trait IllustrableUpdaterTrait {

    function createVisuelsListItem($instance)
    {
        $item = new IllustrableVisuel();
        $item->illustrable_id = $instance->id;
        $item->illustrable_type = get_class($instance);
        return $item;
    }

}