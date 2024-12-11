<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class CustomerController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getCustomerById($id)
    {
        $apiCustomerLink = 'https://dev.boutique-poubeau.fr/api/customers/'.$id.'?ws_key=JDKZRPBTWMIFKGCNJUBTII21JZ42Q226&output_format=JSON';
        $responseCustomers = $this->client->get($apiCustomerLink);

        $customerData = json_decode($responseCustomers->getBody()->getContents(), true);

        return $customerData['customer'];
    }
}
