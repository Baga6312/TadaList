<?php

require_once "dbm.php";

// Ensure that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);  // Bad Request
    echo json_encode(array("error" => "Invalid request method"));
    exit();
}

// Get the JSON data from the request body
$input_data = json_decode(file_get_contents('php://input'), true);

// Check if the required fields are present in the JSON data
if (!isset($input_data['_id']) || !isset($input_data['text'])) {
    http_response_code(400);  // Bad Request
    echo json_encode(array("error" => "Missing required fields"));
    exit();
}

$conn = getDBconnection();

$sql = "INSERT INTO todo (_id, text) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $input_data['_id'], $input_data['text']);

if ($stmt->execute()) {
    header('Content-Type: application/json');

    // Prepare JSON response data
    $responseData = array(
        "message" => "New record created successfully"
    );

    // Send the JSON response
    echo json_encode($responseData);
} else {
    http_response_code(500);  // Internal Server Error
    echo json_encode(array("error" => $stmt->error));
}

$stmt->close();
$conn->close();

?>
