<?php namespace Idee\Core;

use Idee\Core\Utils\ModelWithSharpUploadTrait;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model {

    use ModelWithSharpUploadTrait;

    public function visuels()
    {
        return $this->morphMany('\Idee\Core\IllustrableVisuel', 'illustrable')
            ->orderBy("ordre", "asc");
    }

    public function visuel()
    {
        return $this->morphOne('\Idee\Core\Upload', 'owner')
            ->where('owner_key', 'visuel');
    }

    public function fichiers()
    {
        return $this->hasMany('\Idee\Core\ProjetFichier')
            ->orderBy("ordre", "asc");
    }

    public function partenaires()
    {
        return $this->hasMany('\Idee\Core\Partenaire')
            ->orderBy("ordre", "asc");
    }

    public function contenu() {
        return $this->belongsTo('\Idee\Core\Contenu');
    }
}