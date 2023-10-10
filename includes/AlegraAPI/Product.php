<?php

// https://api.alegra.com/api/v1/items

use Alex\Alegra\AlegraAPI\BaseController;

class Product extends BaseController {

    public function register(){

    }

    public function init() {

    }

    public function verifyProduct( string $sku ) {
        // https://api.alegra.com/api/v1/items?reference=sku
        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $this->hash"
                )
        );

        $res = wp_remote_get( "$this->item?reference=$sku", $args );

        return wp_remote_retrieve_body( $res );
    }

    public function createProduct() {

    }

    public function addProductID(){

    }

    public function handleProduct( $product ) {
        return $data = array(
            "inventory" => array(
                "unit" => "unit"
            ),
            "name" => "Woo product name",
            "description" => "Some description!",
            "reference" => "SKU",
            "price" => 100000
        );
    }
}