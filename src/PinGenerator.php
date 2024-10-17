<?php

namespace Bfg\Task;

class PinGenerator
{
    
    public function isSequential($pin) {
        // Check if the digits in the pin are sequential (either increasing or decreasing)
        for ($i = 0; $i < strlen($pin) - 1; $i++) {
            if (abs($pin[$i] - $pin[$i + 1]) !== 1) {
                return false;
            }
        }
        return true;
    }

    public function isRepeating($pin) {
        // Check if the pin contains repeating numbers (e.g., 2233)
        return count(array_unique(str_split($pin))) !== strlen($pin);
    }

    public function isPalindrome($pin) {
        // Check if the pin is a palindrome (e.g., 2332)
        return $pin === strrev($pin);
    }

    public function generate(int $totalNumberOfPin = 4, int $length = 4): array
    {
        $generatedPINs = [];

        while (count($generatedPINs) < $totalNumberOfPin) {
            // Generate random PIN with specified length
            $pin = '';
            for ($i = 0; $i < $length; $i++) {
                $pin .= rand(0, 9);
            }

            // Ensure the pin is not sequential, repeating, or a palindrome, and it's unique
            if (!$this->isSequential($pin) && !$this->isRepeating($pin) && !$this->isPalindrome($pin) && !in_array($pin, $generatedPINs)) {
                $generatedPINs[] = $pin;
            }
        }

        return $generatedPINs;
    }
}
