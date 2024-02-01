<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../config/dbconfig.php';
require_once '../src/controllers/BingoCardController.php';
require_once '../src/controllers/BingoCallerController.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bingoCallerController = new BingoCallerController($conn);

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['rowIndex'], $data['colIndex'], $data['cardId'])) {
    $rowIndex = $data['rowIndex'];
    $colIndex = $data['colIndex'];
    $cardId = $data['cardId'];

    $response = array('message' => 'Data received successfully');
    echo json_encode($response);
} else if (isset($data['displayedNumber'])) {
    $displayedNumber = $data['displayedNumber'];

    $response = array('message' => 'Data received successfully');
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'Invalid data received'));
}

?>

