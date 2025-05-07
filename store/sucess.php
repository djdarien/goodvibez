<?php
require 'vendor/autoload.php';
include 'db.php';

$stripe = new \Stripe\StripeClient('sk_test_your_api_key_here');
$session_id = $_GET['session_id'];
$session = $stripe->checkout->sessions->retrieve($session_id);

if ($session) {
    // In production, verify line_items separately
    $stmt = $pdo->prepare("INSERT INTO orders (stripe_session_id, product_id, quantity, total_amount) VALUES (?, ?, ?, ?)");
    $stmt->execute([$session_id, 1, 1, $session->amount_total / 100]); // simplify for now
    echo "<h1>Thank you! Your order was successful.</h1>";
}
?>
