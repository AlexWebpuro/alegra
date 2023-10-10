<?php

namespace Alex\Alegra\AlegraAPI;

use Alex\Alegra\AlegraAPI\BaseController;

class Customer extends BaseController
{
    public $order_id =  null;

    protected $order = null;

    public function register() {
        add_action( 'woocommerce_order_status_pending_to_failed', array( $this, 'init' ) );
    }

	public function init( $order_id ) {

        $order_id = $this->order_id = $order_id;
        $order = wc_get_order( $this->order_id );
        $this->order = $order;
        $doc_id = $this->getDocID();

        $this->verifyCustomer( $order_id, $doc_id  );
        // $this->createCustomer();
        // $this->registerInWoo();
        // $this->createBill();

        // $IsCustomerCreated = $this->verifyCustomer( 31, '79657063' );


        // var_dump( $IsCustomerCreated );
	}

    public function getDocID() {
        $order = $this->order;
        $doc_id = $order->get_meta('_billing_doc_id');
        return $doc_id;
    }

    // Verify customer is already in Alegra
    public function verifyCustomer( int $order_id, string $doc_id ) {

        $alegra_ID = $this->isCostumerIDinWoo( $order_id );

        if ( $alegra_ID ) return;
        // Trigger request to know if this cliente was created in alegra
        $hash = base64_encode( "$this->user:$this->token");
        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $hash"
                )
            );
        $response = wp_remote_get( "$this->create_contact?identification=$doc_id", $args );
        $body = wp_remote_retrieve_body( $response );
        $body = json_decode( $body );
        $status = wp_remote_retrieve_response_code( $response );

        if( empty( $body ) ) {
            $this->order->add_order_note("Customer with document ID: $doc_id does not exist in Alegra.");
            // $alegra_user_id = $body->id ? $body->id  : null;
            $alegra_user_id = $this->createCustomer( $order_id );
            // var_dump( $alegra_user_id );
            $this->addAlegraID( $order_id, $alegra_user_id );
            return false;
        }

        return true;
    }

    public function addAlegraID( int $order_id, int $id ) {
        $note = 'Save Alegra customer ID in order.';
        $order = wc_get_order( $order_id );
        $order->add_meta_data('_alegra_user_id', $id, true );
        $order->add_order_note( $note );
        $order->save_meta_data();
    }

    // Verify Alegra ID is in woo
    public function isCostumerIDinWoo( int $order_id ) {
        $order = wc_get_order( $order_id );
        if( ! $order->get_meta('_alegra_user_id') ) {
            return false;
        }
        return true;
    }

    public function handleCostumer( int $order_id ) {

        // Create contact in Alegra from billing order info 
        $order = wc_get_order( $order_id );

        $email = $order->get_billing_email();
        $first_name = $order->get_billing_first_name();
        $last_name = $order->get_billing_last_name();
        $phone = $order->get_billing_phone();
        $doc_type = $order->get_meta('_billing_doc_type');
        $doc_id = $order->get_meta('_billing_doc_id');
    
        $body = array(
            "nameObject" => array(
              "firstName" 		=> $first_name,
              "secondName" 		=> $first_name,
              "lastName" 		=> $last_name,
              "secondLastName" 	=> $last_name
            ),
            "identificationObject" => array(
                "type" 			=> $doc_type,
                "number" 		=> $doc_id
            ),
            "kindOfPerson" 		=> "PERSON_ENTITY",
            "regime" 			=> "SIMPLIFIED_REGIME",
            "phonePrimary" 		=> $phone,
            "mobile" 			=> $phone,
            "email" 			=> $email,
            "emailSecondary" 	=> "",
            "type" 				=> "client",
            "status" 			=> "active"
        );
        $data = json_encode( $body );

        return $data;
    }


    public function createCustomer( $order_id ) {

        $data = $this->handleCostumer( $order_id );

        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => $this->hash,
            ),
            'body' => $data
        );

        $response = wp_remote_post( $this->create_contact, $args );
        $body = wp_remote_retrieve_body( $response );
        $body = json_decode( $body );

        $this->order->add_order_note("Customer created in Alegra with ID: $body->id");

        return $body->id;
    }
}