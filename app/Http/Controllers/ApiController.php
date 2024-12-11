<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
// A faire : un controller pour le carrier (transporteur),OK
// qui permette de retourner le nom du transporteur OK
// à partir de l'identifiant qui est présent dans arrayOrders[i]['transporteur']
// de chaque commande. NON

class ApiController extends Controller
{

    protected $orderController;
    protected $customerController;

    protected $carrierController;

    public function __construct(OrderController $orderController, CustomerController $customerController, CarrierController $carrierController)
    {
        $this->orderController = $orderController;
        $this->customerController = $customerController;
        $this->carrierController = $carrierController;
    }

    public function __invoke()
    {
        // Récupérer les commandes
        $orders = $this->orderController->getOrders();
        // clef valeur en bas?.?
        $arrayOrders = [];

        if (!empty($orders)) {
            foreach ($orders as $i=> $order) {
                // Récupérer les informations du client
                $customer = $this->customerController->getCustomerById($order['id_customer']);
                $carriers = $this->carrierController->getCarrier();
                // Formater les données
                $arrayOrders[$i]['order_reference'] = $order['reference'];
                $arrayOrders[$i]['current_state'] = $order['current_state'];


                foreach ($carriers as $carrier) {
                    if($carrier['id'] == $order['id_carrier']) {
                        $arrayOrders[$i]['transporter'] = $carrier['name'];
                        break;
                    }
                }

                $arrayOrders[$i]['customer'] = $customer['firstname'] . " " . $customer['lastname'];
                $arrayOrders[$i]['product_quantity'] = count($order['associations']['order_rows']);
                $arrayOrders[$i]['products'] = [];
                foreach ($order['associations']['order_rows'] as $product) {
                    array_push($arrayOrders[$i]['products'], $product);
                }

            }

        }



        return view('welcome', compact('arrayOrders'));
    }


}
