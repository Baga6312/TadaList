<?php

require_once "dbm.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);  
    echo json_encode(array("error" => "Invalid request method"));
    exit();
}

$input_data = json_decode(file_get_contents('php://input'), true);

if (!isset($input_data['text'])) {
    http_response_code(400);  
    echo json_encode(array("error" => "Missing required fields"));
    exit();
}

$conn = getDBconnection();

$sql = "SELECT MAX(CAST(_id AS SIGNED)) AS max_id FROM todo";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $last_id = $row['max_id'];
    $new_id = strval($last_id + 1);
} else {
   
    $new_id = "1";
}

$sql = "INSERT INTO todo (_id, text) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $new_id, $input_data['text']);

if ($stmt->execute()) {
    header('Content-Type: application/json');

    $responseData = array(
        "message" => "New record created successfully"
    );

    echo json_encode($responseData);
} else {
    http_response_code(500);  
    echo json_encode(array("error" => $stmt->error));
}

$stmt->close();
$conn->close();
