<?php
require 'vendor/autoload.php';
include 'db.php';

$stripe = new \Stripe\StripeClient('sk_test_your_api_key_here'); // Replace with your key

$product_id = $_POST['product_id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

$checkout_session = $stripe->checkout->sessions->create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'product_data' => [
        'name' => $product['name'],
      ],
      'unit_amount' => $product['price'] * 100,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'https://yourdomain.com/success.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => 'https://yourdomain.com/cancel.php',
]);

header("Location: " . $checkout_session->url);
exit;
?>
