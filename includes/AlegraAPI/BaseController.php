<?php

namespace Alex\Alegra\AlegraAPI;

class BaseController
{
    public $user;
    
    public $token;

    protected $hash;

    public $contact;

    public $create_contact;

    public $item;


    public function __construct() {
        $this->user = get_option( 'alegra_user' );
        $this->token = get_option( 'alegra_pass' );
        $this->hash = "Basic " . base64_encode( "$this->user:$this->token");
        $this->contact = 'https://api.alegra.com/api/v1/';
        $this->create_contact = 'https://api.alegra.com/api/v1/contacts';
        $this->item = "https://api.alegra.com/api/v1/items";
    }
}
