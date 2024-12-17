<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OrderController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getOrders()
    {
        $responseOrders = $this->client->get('https://dev.boutique-poubeau.fr/api/orders?ws_key=JDKZRPBTWMIFKGCNJUBTII21JZ42Q226&filter[current_state]=3&display=full&output_format=JSON');
        $data = json_decode($responseOrders->getBody()->getContents(), true);
        return $data['orders'];
    }

    public function getProductsInOrder(array $order):array {
        $arrayReferences = [];

        $o = 0;
        foreach ($order as $product){
            $arrayReferences[$o]['reference'] = $product['product_reference'];
            $arrayReferences[$o]['product_name'] = $product['product_name'];
            $arrayReferences[$o]['product_quantity'] = $product['product_quantity'];
            $o++;
        }
        return $arrayReferences;
    }


}
