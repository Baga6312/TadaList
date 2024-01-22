<?php
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Establish database connection with error handling
$conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE'])
    or die("Connection failed: " . mysqli_connect_error()); 
// Function to access the database connection
function getDBConnection() {
    global $conn;
    return $conn;
}
