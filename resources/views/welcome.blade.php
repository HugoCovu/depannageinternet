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

            <div class="d-flex" id="changingContainer">

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
                <div class="d-flex col-7 m-4 flex-column">
                    <h2 class="d-block mb-3">Détails produits :</h2>
                    <div class="card-body d-flex flex-wrap cardJs" style="width: 100%;">
                        @foreach($finalArray as $ref => $product)
                            <div class="card mb-3" style="width: 30%; border: 1px solid #ddd; margin: 5px;">
                                <div class="card-header bg-primary text-white">
                                    Référence : {{ $ref }}
                                </div>
                                <div class="card-body d-flex cardModified">
                                    <div>
                                        <div class="nameProduct">
                                            <strong>Produits :</strong>
                                            <span>{{ $product['name'] }}</span>
                                            <br>
                                        </div>
                                        <div class="d-flex">
                                            <strong class="quantity">Quantité :</strong>
                                            <span class="badge bg-danger badge-quantite">{{ $product['quantity'] }}</span>
                                            <div class="d-flex">
                                                <div class="reference"></div>
                                                <input type="checkbox" class="checkboxClass" id="product-{{ $ref }}" style="width: 100px; display:flex; margin-left: -40px; justify-content:start;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="sidebar" style="visibility: hidden;">
                <ul></ul>
                <div class="nothingForNow">
                    <input type="submit" value="Envoyer"/>

                </div>
            </div>

    </div>
</div>
</body>
</html>
