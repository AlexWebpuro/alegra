<?php

namespace Alex\Alegra\AlegraAPI;

class Alegra
{
    protected $user = '';

    protected $token = '';

    public function register() {
        $this->getCretentials(  );
        // $this->testAPIConnection();
    }
    
    public function getCretentials(  ) {

        $user = get_option( 'alegra_user' );
        $token = get_option( 'alegra_pass' );
        $this->user = $user;
        $this->token = $token;
        return $this;
    }

    public function testAPIConnection(  ) {
        $hash = base64_encode( "$this->user:$this->token");
        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $hash"
            )
        );
        $response = wp_remote_get( 'https://api.alegra.com/api/v1/contacts?order_direction=ASC', $args );
        $status = wp_remote_retrieve_response_code( $response );

        if( $status !== 200 ) {
            // return dump($status);
            return "Error status $status";
        }

        return "$status";
    }
}