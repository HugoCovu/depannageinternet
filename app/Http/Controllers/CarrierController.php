<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getCarrier()
    {
        $responseCarrier = $this->client->get('https://dev.boutique-poubeau.fr/api/carriers?ws_key=JDKZRPBTWMIFKGCNJUBTII21JZ42Q226&display=full&output_format=JSON');

        $carrierData = json_decode($responseCarrier->getBody()->getContents(), true);


        return $carrierData['carriers'];


    }


}
