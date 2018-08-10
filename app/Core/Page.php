<?php namespace Idee\Core;

use Idee\Core\Utils\ModelWithSharpUploadTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    use ModelWithSharpUploadTrait;

    public function contenu() {
        return $this->belongsTo('\Idee\Core\Contenu');
    }

    public function visuel()
    {
        return $this->morphOne('\Idee\Core\Upload', 'owner')
            ->where('owner_key', 'visuel');
    }
}