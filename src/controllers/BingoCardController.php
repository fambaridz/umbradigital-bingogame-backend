<?php

class BingoCardController
{
    protected $ranges;

    public function __construct()
    {
        $this->ranges = array(
            'B' => range(1, 25),
            'I' => range(26, 40),
            'N' => range(41, 55),
            'G' => range(56, 70),
            'O' => range(71, 85)
        );
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

        return $bingoCard;
    }
}

?>