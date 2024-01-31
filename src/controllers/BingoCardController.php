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

    public function generateBingoCard()
    {
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
        $sql = "INSERT INTO cards (card_numbers) VALUES ('$jsonData')";
        
        if ($this->conn->query($sql) === TRUE) {
            $gameId = $this->conn->insert_id;
            $response = array('id' => $gameId, 'numbers' => $bingoCard);
            return $response;
        } else {
            return "Error storing data in the database: " . $this->conn->error;
        }
    }
}

?>