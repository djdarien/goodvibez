<?php
session_start();

if (!isset($_SESSION['submitted']) || !$_SESSION['submitted']) {
    echo "<p>You must complete the questionnaire before viewing this page.</p>";
    exit();
}

$userID = $_SESSION['userID'];

// Connect to the database and retrieve the data for the logged-in user
$conn = new mysqli('localhost', 'username', 'password', 'vendor_application');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT name, location, product, audience FROM vendors WHERE userid = ?");
$stmt->bind_param("s", $userID);
$stmt->execute();
$stmt->bind_result($name, $location, $product, $audience);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($name) {
    echo "<h2>Your Vendor Bio</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Location:</strong> $location</p>";
    echo "<p><strong>Product:</strong> $product</p>";
    echo "<p><strong>Audience:</strong> $audience</p>";
} else {
    echo "<p>No data found for your UserID.</p>";
}
?>
