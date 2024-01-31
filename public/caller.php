<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../config/dbconfig.php';
require_once '../src/controllers/BingoCardController.php';
require_once '../src/controllers/BingoCallerController.php';

$bingoCallerController = new BingoCallerController();

// API endpoint to generate and return a bingo card or a bingo call
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $bingoCallData = $bingoCallerController->generateBingoCall();
    echo json_encode($bingoCallData);
} else {
    echo "Invalid request";
}
