<?php namespace Idee\Core\Utils;

use Idee\Core\Upload;

trait ModelWithSharpUploadTrait {

    public function getSharpFilePathFor($attribute)
    {
        if($this->$attribute && $this->$attribute instanceof Upload)
        {
            // $this->attribute désigne un Upload (morphOne) ; on appelle getSharpFilePathFor()
            // de Upload avec comme nom d'attribut le owner_key
            return $this->$attribute->getSharpFilePath();
        }

        return null;
    }

}