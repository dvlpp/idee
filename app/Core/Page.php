<?php namespace Idee\Core;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    public function contenu() {
        return $this->belongsTo('\Idee\Core\Contenu');
    }
}