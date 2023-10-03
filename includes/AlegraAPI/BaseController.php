<?php

namespace Alex\Alegra\AlegraAPI;

class BaseController
{
    public $contact;
    public $crete_contact;

    public function __construct() {
        $this->contact = 'https://api.alegra.com/api/v1/';
        $this->crete_contact = 'https://api.alegra.com/api/v1/contacts';
    }    
}
