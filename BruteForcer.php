<?php

/*
BF PHP

Usage:
$bf = new BruteForcer();
echo $bf->match('hello');

Example with hasher:
$hasher = function($str) {
  $arr = str_split($str);
  $out = 1;
  foreach($arr as $char) {
    $out *= ord($char);
  }
  return $out;
};

echo $bf->match(13599570816, $hasher);
*/

class BruteForcer {

    public $roundcount;
    public $minlength;
    public $maxlength;
    public $alphabet;
    public $alphaArray;
    public $workingArray = array();

    public function __construct(int $minlength = 1, int $maxlength = 8, string $alphabet = 'abcdefghijklmnopqrstuvwxyz0123456789', array $initializeArr = null) {
        if ($minlength > $maxlength) {
            throw new Error('$minlength is greater than $maxlength');
        }

        $this->minlength  = $minlength;
        $this->maxlength  = $maxlength;
        $this->alphabet   = $alphabet;
        $this->alphaArray = str_split($this->alphabet);
        $this->roundcount = 0;

        // Initialize working array
        if (!is_null($initializeArr)) {
            $this->workingArray = $initializeArr;

            if (count($initializeArr) < $this->minlength) {
                for ($i = count($initializeArr); $i < $this->minlength; $i++) {
                    array_push($this->workingArray, $this->alphaArray[0]);
                }
            } else {
                $this->minlength = count($initializeArr);
            }
        } else {
            for ($i = 0; $i < $this->minlength; $i++) {
                array_push($this->workingArray, $this->alphaArray[0]);
            }
        }
    }

    // Callback is for the generated string.
    // For example if you need to hash the result for matching,
    // $callback would be the hashing function
    public function match($matchString = '', $callback = null) {
        if (!is_null($callback) && !is_callable($callback)) {
            throw new Error('Callback is not a function');
        }

        if (is_null($callback) && $matchString > $this->maxlength) {
            throw new Error('String to match is longer than $maxlength, it will never match');
        }

        // Setting checker function
        if (!is_null($callback) && is_callable($callback)) {
            $checkMatch = function($str) use ($matchString, $callback) {
                return ($callback($str) === $matchString);
            };
        } else {
            $checkMatch = function($str) use ($matchString) {
                return $str === $matchString;
            };
        }

        // Processing loop
        while (count($this->workingArray) <= $this->maxlength) {
            $workStr = implode('', $this->workingArray);

            if ($checkMatch($workStr)) {
                return $workStr;
            }

            $this->workingIndex = count($this->workingArray) - 1;
            $this->updateWorkingArray();
        }

        return false;
    }

    private function updateWorkingArray() {
        // Increment rounds counter
        $this->roundcount++;

        /*
        At start, $this->workingIndex is the last entry of workingArray

        Check index of $this->workingArray
          - if entry is equal to last char of alphabet, reset to first character, and
            - if there is a previous entry, recurse
            - else if length workArray < this.maxlength, prepend alphabet[0] to workArray
            - else if length workArray === this.maxlength, and all characters at max, end
          - else up the current character
        */
        if (array_search($this->workingArray[$this->workingIndex], $this->alphaArray) === count($this->alphaArray) - 1) {
            $this->workingArray[$this->workingIndex] = $this->alphaArray[0];

            if ($this->workingIndex > 0) {
                $this->workingIndex--;
                $this->updateWorkingArray();
            } else if (count($this->workingArray) < $this->maxlength) {
                array_unshift($this->workingArray, $this->alphaArray[0]);
            } else {
                die('No matches found');
            }
        } else {
            $this->workingArray[$this->workingIndex] = $this->alphaArray[array_search($this->workingArray[$this->workingIndex], $this->alphaArray) + 1];
        }
    }
}
