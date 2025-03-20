<?php
// Use server diagnostics data
$serverHost = $_SERVER['SERVER_ADDR'];  // Correctly get the server's IP address
$remoteAddr = $_SERVER['REMOTE_ADDR'];  // Correctly get the client's IP address

// Database configuration
define('DB_SERVER', $serverHost);  // Dynamically use the server's IP address
define('DB_USERNAME', 'tori');
define('DB_PASSWORD', '2231');  // Replace with your actual password
define('DB_DATABASE', 'vendor_application');

// Port configuration
define('PORT', 3306);

// Site configuration
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . ':' . PORT);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to connect to the database
function getDBConnection() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "<br>Hostname: " . DB_SERVER . "<br>Username: " . DB_USERNAME . "<br>Database: " . DB_DATABASE);
    }

    return $conn;
}

// Example usage
$conn = getDBConnection();
if ($conn) {
    echo "Connected to the database successfully from " . $remoteAddr;
}
?>
