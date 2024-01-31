<?php

require_once('BingoCardController.php');

class BingoCallerController extends BingoCardController
{
    public function generateBingoCall()
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

        return $calls;
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
