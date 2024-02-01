<?php

class BingoCardController
{
    protected $ranges;
    protected $conn;

    public function __construct($conn)
    {
        $this->ranges = array(
            'B' => range(1, 25),
            'I' => range(26, 40),
            'N' => range(41, 55),
            'G' => range(56, 70),
            'O' => range(71, 85)
        );
        $this->conn = $conn;
    }

    public function generateBingoCard() {
        $bingoCard = array();

        foreach ($this->ranges as $letter => $range) {
            shuffle($range);
            $numbers = array_slice($range, 0, 5);

            if ($letter == 'N') {
                $numbers[2] = 'FREE';
            }

            for ($i = 0; $i < 5; $i++) {
                $bingoCard[$i][$letter] = $numbers[$i];
            }
        }

        $jsonData = json_encode($bingoCard);
        $sql = "INSERT INTO cards (card_numbers) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return ['error' => 'Database error: ' . $this->conn->error];
        }

        $stmt->bind_param("s", $jsonData);
        $success = $stmt->execute();

        if (!$success) {
            return ['error' => 'Insertion error: ' . $stmt->error];
        }

        $cardId = $stmt->insert_id;

        $stmt->close();

        $response = array('id' => $cardId, 'numbers' => $bingoCard);
        return $response;
    }
}

?>