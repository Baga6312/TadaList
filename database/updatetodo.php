<?php

require_once "dbm.php";

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(400);  
    echo json_encode(array("error" => "Invalid request method"));
    exit();
}

$input_data = json_decode(file_get_contents('php://input'), true);

if (!isset($input_data['_id']) || !isset($input_data['text'])) {
    http_response_code(400);  
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
    $responseData = array(
        "message" => "Record updated successfully",
        "id" => $id,
        "newText" => $newText
    );

    header('Content-Type: application/json');
    echo json_encode($responseData);
} else {
    http_response_code(500);  
    echo json_encode(array("error" => $stmt->error));
}

$stmt->close();
$conn->close();
