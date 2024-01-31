<?php

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
