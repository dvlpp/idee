<?php namespace Idee\Core;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    protected $fillable = ["fichier", "owner_type", "owner_id", "owner_key", "typemime"];

    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Return the full path of a file.
     *
     * @return mixed
     */
    function getSharpFilePath()
    {
        if($this->owner_type)
        {
            $type = substr($this->owner_type, strrpos($this->owner_type, '\\')+1);
            return storage_path("app/data/$type/{$this->owner_id}/{$this->fichier}");
        }

        return null;
    }

} 