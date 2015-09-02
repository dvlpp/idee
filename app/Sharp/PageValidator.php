<?php namespace Idee\Sharp;

use Dvlpp\Sharp\Validation\SharpValidator;

class PageValidator extends SharpValidator {

    protected $rules = [
        "key" => "required|alpha_dash",
        "contenu~titre" => "required",
        "contenu~chapo" => "required"
    ];

}