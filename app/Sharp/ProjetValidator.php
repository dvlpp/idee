<?php namespace Idee\Sharp;

use Dvlpp\Sharp\Validation\SharpValidator;

class ProjetValidator extends SharpValidator {

    protected $rules = [
        "contenu~titre" => "required",
        "contenu~chapo" => "required"
    ];

}