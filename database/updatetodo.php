<?php

require_once "dbm.php";

// Ensure that the request is a PUT request
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
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

$id = $input_data['_id'];
$newText = $input_data['text'];

$conn = getDBconnection();

$sql = "UPDATE todo SET text = ? WHERE _id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $newText, $id);

if ($stmt->execute()) {
    // Prepare JSON response data
    $responseData = array(
        "message" => "Record updated successfully",
        "id" => $id,
        "newText" => $newText
    );

    // Set appropriate headers
    header('Content-Type: application/json');

    // Send JSON response
    echo json_encode($responseData);
} else {
    http_response_code(500);  // Internal Server Error
    echo json_encode(array("error" => $stmt->error));
}

$stmt->close();
$conn->close();

?>
