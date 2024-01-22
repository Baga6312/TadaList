<?php
require_once "dbm.php";

$conn = getDBconnection();

$sql = "SELECT * FROM todo";

$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);  // Set error status code
    die("Error: " . $conn->error);
}

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

header('Content-Type: application/json');

echo $json;

$conn->close();
