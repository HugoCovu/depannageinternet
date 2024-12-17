<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépannage internet</title>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>
<body>
<div class="container-fluid">
    <h1>Dépannage Internet</h1>
    <div>
        @if (empty($arrayOrders))
            <div class="alert alert-warning" role="alert">
                Aucune commande en attente.
            </div>
        @else
            <h2>Commandes en attente ({{ count($arrayOrders) }})</h2>

            <div class="d-flex">

                <div class="col-5">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Référence Commande</th>
                                <th scope="col">Client</th>
                                <th scope="col">Transporteur</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($arrayOrders as $order)
                            <tr>
                                <td>{{ $order['order_reference'] }}</td>
                                <td>{{ $order['customer'] }}</td>
                                <td>{{ $order['transporter'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-7 m-4">
                <h2>Détails produits : </h2>
                    @foreach($arrayReferences as $orderProducts)
                        @foreach($orderProducts as $product) <!-- Deuxième boucle pour accéder à chaque produit -->
                        <p>
                            Nom du ou des Produits : {{ $product['product_name'] }}
                            {{ $product['product_quantity'] }}x
                            <input type="checkbox">
                        </p>
                        @endforeach
                    @endforeach
                    <div>
                        <input type="submit" value="Envoyer"/>
                    </div>
                </div>
        @endif
    </div>
</div>
    </div>
</body>
</html>
