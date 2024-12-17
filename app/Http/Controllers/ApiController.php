<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use function Laravel\Prompts\warning;
use function PHPUnit\Framework\stringContains;

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
        $arrayReferences = [];
        $compareArrays = [];

        if (!empty($orders)) {
            foreach ($orders as $i => $order) {
                // Récupérer les informations du client
                $customer = $this->customerController->getCustomerById($order['id_customer']);
                $carriers = $this->carrierController->getCarrier();
                // Formater les données
                $arrayOrders[$i]['order_reference'] = $order['reference'];
                $arrayOrders[$i]['current_state'] = $order['current_state'];

                // avoir le nom du transporteur ainsi que son nom
                foreach ($carriers as $carrier) {
                    if ($carrier['id'] == $order['id_carrier']) {
                        $arrayOrders[$i]['transporter'] = $carrier['name'];
                        break;
                    }
                }

                $arrayOrders[$i]['customer'] = $customer['firstname'] . " " . $customer['lastname'];
                $arrayOrders[$i]['product_quantity'] = count($order['associations']['order_rows']);

                array_push($arrayReferences, $this->orderController->getProductsInOrder($order['associations']['order_rows']));

            }


//                if($arrayReferences[$i]['product_name'] === $compareArrays[$i]['product_name']) {
//                    echo $arrayOrders[$i] . ':' . 'est pareil' . $arrayReferences[$i];
//                }


//
//                if($arrayOrders[$i]['product_name'] === $arrayReferences[$i]['product_name']) {
//                    echo $arrayOrders[$i] . ':' . 'est pareil' . $arrayReferences[$i];
//                }

//                }

//               if(array_intersect_key($arrayReferences ==)) {
//
//               }


        }


        for ($i = 0; $i < count($arrayReferences); $i++) {
            foreach ($arrayReferences[$i] as $item) {
                if (!empty($item['reference']&& !empty($item['product_name'] && !empty($item['product_quantity']) ))) {
                    $compareArrays[] = $item['reference'] ." ". $item['product_name'] . " ". $item['product_quantity'];



                }
            }
        }


//        for ($i = 0; $i < count($arrayReferences); $i++) {
//            foreach ($arrayReferences[$i] as $item) {
//                if (!empty($item['product_quantity'])) {
//                    $compareArrays[] = $item['product_quantity'];
//                }
//            }
//        }
//        for ($i = 0; $i < count($arrayReferences); $i++) {
//            foreach ($arrayReferences[$i] as $item) {
//                if (!empty($item['reference'])) {
//                    $compareArrays[] = $item['reference'];
//                }
//            }
//        }
//
//



//        for ($i = 0; $i < count($arrayReferences); $i++) {
//            if ($arrayReferences[$i][0]['product_name'] == $compareArrays[$i]) {
//                 return ; // Les valeurs sont égales, on retourne
//            }
//        }

       dd($compareArrays);

            return view('welcome', compact('arrayOrders', 'arrayReferences'));
        }


}
