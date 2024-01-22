<?php

require_once "dbm.php";

// Ensure that the request is a DELETE request
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(400);  // Bad Request
    echo json_encode(array("error" => "Invalid request method"));
    exit();
}

// Get the JSON data from the request body
$input_data = json_decode(file_get_contents('php://input'), true);

// Check if the required field is present in the JSON data
if (!isset($input_data['_id'])) {
    http_response_code(400);  // Bad Request
    echo json_encode(array("error" => "Missing required field"));
    exit();
}

$id = $input_data['_id'];

$conn = getDBconnection();

$sql = "DELETE FROM todo WHERE _id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    // Set appropriate headers for JSON response
    header('Content-Type: application/json');

    // Prepare JSON response data
    $responseData = array(
        "message" => "Record deleted successfully"
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
