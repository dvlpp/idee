<?php namespace Idee\Core;

use Idee\Core\Utils\ModelWithSharpUploadTrait;
use Dvlpp\Sharp\Repositories\SharpModelWithFiles;
use Illuminate\Database\Eloquent\Model;

class IllustrableVisuel extends Model implements SharpModelWithFiles {

    use ModelWithSharpUploadTrait;

    public function illustrable()
    {
        return $this->morphTo();
    }

    public function photo()
    {
        return $this->morphOne('\Idee\Core\Upload', 'owner')
            ->where('owner_key', 'photo');
    }

} 