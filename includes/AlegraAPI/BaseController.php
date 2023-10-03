<?php

namespace Alex\Alegra\AlegraAPI;

class BaseController
{
    public $contact;

    public function __construct() {
        $this->contact = 'https://api.alegra.com/api/v1/';
    }    
}
