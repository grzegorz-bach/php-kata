<?php

namespace App;

class RomanNumerals
{
  const NUMERALS = [
    'M' => 1000,
    'CM' => 900,
    'D' => 500,
    'CD' => 400,
    'C' => 100,
    'XC' => 90,
    'L' => 50,
    'XL' => 40,
    'X' => 10,
    'IX' => 9,
    'V' => 5,
    'IV' => 4,
    'I' => 1
  ];

  const MIN_VALUE = 1;
  const MAX_VALUE = 3999;

  public static function generate(int $number): string|bool
  {
    if ($number < static::MIN_VALUE || $number > static::MAX_VALUE) {
      return false;
    }

    $result = '';

    foreach (static::NUMERALS as $numeral => $arabic) {
      for (; $number >= $arabic; $number -= $arabic) {
        $result .= $numeral;
      }
    }

    return $result;
  }
}
