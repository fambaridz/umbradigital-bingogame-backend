<?php

require_once('BingoCardController.php');

class BingoCallerController extends BingoCardController
{
    public function generateBingoCall($cardId)
    {
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

        $sql = "INSERT INTO games (numbers, card_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return ['error' => 'Database error: ' . $this->conn->error];
        }
        
        $jsonCalls = json_encode($calls);

        $stmt->bind_param("si", $jsonCalls, $cardId);
        $success = $stmt->execute();

        if (!$success) {
            return ['error' => 'Insertion error: ' . $stmt->error];
        }

        $gameId = $stmt->insert_id;

        $stmt->close();

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
