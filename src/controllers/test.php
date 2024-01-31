<?php

require_once('BingoCardController.php');

$bingoController = new BingoCardController();
$generatedCard = $bingoController->generateBingoCard();

// Print the generated bingo card
print_r($generatedCard);
