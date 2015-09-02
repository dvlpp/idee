<?php namespace Idee\Core;

use Idee\Core\Utils\ModelWithSharpUploadTrait;
use Dvlpp\Sharp\Repositories\SharpModelWithFiles;
use Illuminate\Database\Eloquent\Model;

class ProjetFichier extends Model implements SharpModelWithFiles {

    use ModelWithSharpUploadTrait;

    public function projet()
    {
        return $this->belongsTo('\Idee\Core\Projet');
    }

    public function fichier()
    {
        return $this->morphOne('\Idee\Core\Upload', 'owner')
            ->where('owner_key', 'fichier');
    }

    public function getExtensionAttribute()
    {
        $tab = explode(".", $this->fichier->fichier);

        return sizeof($tab) ? $tab[sizeof($tab)-1] : null;
    }
} 