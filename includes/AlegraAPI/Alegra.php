<?php

namespace Alex\Alegra\AlegraAPI;
use Alex\Alegra\AlegraAPI\BaseController;

class Alegra extends BaseController
{
    // protected $user = '';

    // protected $token = '';

    public function register() {
        // $this->getCretentials();
        // $this->testAPIConnection();
    }
    
    public function getCretentials(  ) {

        // $user = get_option( 'alegra_user' );
        // $token = get_option( 'alegra_pass' );
        // $this->user = $user;
        // $this->token = $token;
        // return $this;
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
            return $status;
        }

        return $status;
    }

    public function createCostumver() {
        // https://api.alegra.com/api/v1/contacts
        // {
        //     "nameObject": {
        //       "firstName": "Pedro",
        //       "secondName": "Antonio",
        //       "lastName": "Arias",
        //       "secondLastName": "Bastidas"
        //     },
        //     "identificationObject": {
        //       "type": "CC",
        //       "number": "1231232288"
        //     },
        //     "kindOfPerson": "PERSON_ENTITY",
        //     "regime": "SIMPLIFIED_REGIME",
        //     "phonePrimary": "1111111111",
        //     "mobile": "444444444",
        //     "email": "pruebacol@gmail.com",
        //     "emailSecondary": "pruebacol2@gmail.com",
        //     "type": "client",
        //     "status": "active"
        //   }

        // {
        //     "id": "1",
        //     "name": "John Fernando Monroy Baracaldo",
        //     "identification": "79657063",
        //     "email": "alexwebpuro@gmail.com",
        //     "phonePrimary": "3112148208",
        //     "phoneSecondary": null,
        //     "fax": null,
        //     "mobile": "3112148208",
        //     "observations": null,
        //     "status": "active",
        //     "kindOfPerson": "PERSON_ENTITY",
        //     "regime": "SIMPLIFIED_REGIME",
        //     "nameObject": {
        //         "firstName": "John",
        //         "secondName": "Fernando",
        //         "lastName": "Monroy",
        //         "secondLastName": "Baracaldo"
        //     },
        //     "identificationObject": {
        //         "type": "CC",
        //         "number": "79657063"
        //     },
        //     "emailSecondary": "alexwwebpuro@gmail.com",
        //     "enableHealthSector": false,
        //     "healthPatients": null,
        //     "address": {
        //         "address": null,
        //         "city": null,
        //         "department": null,
        //         "country": null,
        //         "zipCode": null
        //     },
        //     "type": [
        //         "client"
        //     ],
        //     "seller": null,
        //     "term": null,
        //     "priceList": null,
        //     "internalContacts": [],
        //     "settings": {
        //         "sendElectronicDocuments": false
        //     },
        //     "statementAttached": false,
        //     "accounting": {
        //         "accountReceivable": {
        //             "id": "5008",
        //             "idParent": "5007",
        //             "name": "Cuentas por cobrar clientes nacionales",
        //             "text": "Cuentas por cobrar clientes nacionales",
        //             "code": null,
        //             "description": "",
        //             "type": "asset",
        //             "readOnly": false,
        //             "nature": "debit",
        //             "blocked": "no",
        //             "status": "active",
        //             "categoryRule": {
        //                 "id": "5",
        //                 "name": "Cuentas por cobrar",
        //                 "key": "RECEIVABLE_ACCOUNTS"
        //             },
        //             "use": "movement",
        //             "showThirdPartyBalance": true
        //         },
        //         "debtToPay": {
        //             "id": "5070",
        //             "idParent": "5069",
        //             "name": "Cuentas por pagar a proveedores nacionales",
        //             "text": "Cuentas por pagar a proveedores nacionales",
        //             "code": null,
        //             "description": "",
        //             "type": "liability",
        //             "readOnly": false,
        //             "nature": "credit",
        //             "blocked": "no",
        //             "status": "active",
        //             "categoryRule": {
        //                 "id": "11",
        //                 "name": "Cuentas por pagar - proveedores",
        //                 "key": "DEBTS_TO_PAY_PROVIDERS"
        //             },
        //             "use": "movement",
        //             "showThirdPartyBalance": true
        //         }
        //     }
        // }
    }

    // $alegra->verifyCostumer()
    //     ->createCostumer()
    //     ->registerInWoo()
    //     ->createBill();
    
}