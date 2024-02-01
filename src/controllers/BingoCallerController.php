<?php

require_once('BingoCardController.php');

class BingoCallerController extends BingoCardController
{
    public function generateBingoCall() {

        $latestCardIdQuery = "SELECT MAX(id) as max_id FROM cards";
        $latestCardIdResult = $this->conn->query($latestCardIdQuery);

        if ($latestCardIdResult && $latestCardIdResult->num_rows > 0) {
            $latestCardIdRow = $latestCardIdResult->fetch_assoc();
            $latestCardId = $latestCardIdRow['max_id'];
        } else {
            return ['error' => 'Failed to fetch the latest card_id'];
        }

        $calls = array();

        $allNumbers = [];
        foreach ($this->ranges as $range) {
            $allNumbers = array_merge($allNumbers, $range);
        }

        shuffle($allNumbers);

        for ($i = 0; $i < 38; $i++) {
            $letter = $this->getLetterForNumber($allNumbers[$i]);
            $calls[] = array('letter' => $letter, 'number' => $allNumbers[$i]);
        }

        $jsonCalls = json_encode($calls);
        $insertQuery = "INSERT INTO games (numbers, card_id) VALUES (?, ?)";
        $insertStmt = $this->conn->prepare($insertQuery);

        if (!$insertStmt) {
            return ['error' => 'Database error: ' . $this->conn->error];
        }

        $insertStmt->bind_param("si", $jsonCalls, $latestCardId);
        $insertSuccess = $insertStmt->execute();

        if (!$insertSuccess) {
            return ['error' => 'Insertion error: ' . $insertStmt->error];
        }

        $gameId = $insertStmt->insert_id;

        $insertStmt->close();

        return array('game_id' => $gameId, 'numbers' => $calls);
    }
    
    private function getLetterForNumber($number)
    {
        foreach ($this->ranges as $letter => $range) {
            if (in_array($number, $range)) {
                return $letter;
            }
        }

        return 'Unknown';
    }
}

?>
