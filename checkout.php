<?php
require 'vendor/autoload.php'; 

\Stripe\Stripe::setApiKey('sk_test_51SAnstB5J5Hnh2Bqjdz64QHKueCplWqktCwkDpznkU9ONjKEBIiJLYwKXqcEYgrstqhrGaPNVKgwwqy4LYT4O23l006laM6gTB'); 
header('Content-Type: application/json');

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'], 
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => 'Produto Exemplo',
            ],
            'unit_amount' => 1000, 
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://teusite.com/sucesso.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'https://teusite.com/cancelado.php',
]);


header("Location: " . $session->url);
exit;
