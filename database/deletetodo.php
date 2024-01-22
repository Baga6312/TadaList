<?php

require_once "dbm.php";

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(400);  
    echo json_encode(array("error" => "Invalid request method"));
    exit();
}

$input_data = json_decode(file_get_contents('php://input'), true);

if (!isset($input_data['_id'])) {
    http_response_code(400);  
    echo json_encode(array("error" => "Missing required field"));
    exit();
}

$id = $input_data['_id'];

$conn = getDBconnection();

$sql = "DELETE FROM todo WHERE _id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    header('Content-Type: application/json');

    $responseData = array(
        "message" => "Record deleted successfully"
    );

    echo json_encode($responseData);
} else {
    http_response_code(500);  
    echo json_encode(array("error" => $stmt->error));
}

$stmt->close();
$conn->close();
