<?php

require_once('BingoCardController.php');

class BingoCallerController extends BingoCardController
{
    public function generateBingoCall()
    {
        $calls = array();

        // Create a combined array of all ranges
        $allNumbers = [];
        foreach ($this->ranges as $range) {
            $allNumbers = array_merge($allNumbers, $range);
        }

        // Shuffle the combined array
        shuffle($allNumbers);

        // Pop the numbers and match them with letters
        for ($i = 0; $i < 38; $i++) {
            $letter = $this->getLetterForNumber($allNumbers[$i]);
            $calls[] = array('letter' => $letter, 'number' => $allNumbers[$i]);
        }

        return $calls;
    }

    // Helper function to get the corresponding letter for a number
    private function getLetterForNumber($number)
    {
        foreach ($this->ranges as $letter => $range) {
            if (in_array($number, $range)) {
                return $letter;
            }
        }

        // Handle the case where the number doesn't match any range
        return 'Unknown';
    }
}

?>
