<?php
require 'vendor/autoload.php'; 

\Stripe\Stripe::setApiKey('sk_test_51SAnstB5J5Hnh2Bqjdz64QHKueCplWqktCwkDpznkU9ONjKEBIiJLYwKXqcEYgrstqhrGaPNVKgwwqy4LYT4O23l006laM6gTB'); 

// Receber o preço via GET
$preco = isset($_GET['preco']) ? floatval($_GET['preco']) : 0;
$valorCents = intval(round($preco * 100)); // converter em cêntimos

if($valorCents <= 0){
    die("Erro: preço inválido. Valor recebido = " . htmlspecialchars($_GET['preco']));
}

// Criar sessão Stripe
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'], 
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => 'Pagamento do Evento',
            ],
            'unit_amount' => $valorCents, // em cêntimos
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost/PuroEncanto_Temp-Main/dashboardCliente.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'https://teusite.com/cancelado.php',
]);

// Redirecionar para o checkout
header("Location: " . $session->url);
exit;
