<?php

namespace App;

class IntegerConversion implements IntegerConversionInterface
{
    public function toRomanNumerals($integer)
    {
        if ($integer <= 0 || $integer >= 4000) {
            return null;
        }

        $result = '';

        $numerals = [
            "M" => 1000,
            "CM" => 900,
            "D" => 500,
            "CD" => 400,
            "C" => 100,
            "XC" => 90,
            "L" => 50,
            "XL" => 40,
            "X" => 10,
            "IX" => 9,
            "V" => 5,
            "IV" => 4,
            "I" => 1
        ];

        foreach ($numerals as $roman => $arabic) {
            $quotient = (int) ($integer / $arabic);
            $result .= str_repeat($roman, $quotient);
            $integer = $integer - ($quotient * $arabic);
        }

        return $result;
    }
}
