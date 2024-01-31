<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once '../config/dbconfig.php';
require_once '../src/controllers/BingoCardController.php';

$bingoController = new BingoCardController();

// API endpoint to generate and return a bingo card
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bingoCardData = $bingoController->generateBingoCard();
    echo json_encode($bingoCardData);
} else {
    echo "Invalid request";
}
