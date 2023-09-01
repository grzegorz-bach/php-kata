<?php

namespace App;

use OutOfRangeException;

class StringCalculator
{
  const MIN_VALUE = 0;
  const MAX_VALUE = 1000;
  const DEFAULT_DELIMITER = ",|\n";
  const CUSTOM_DELIMITER_PATTERN = "/\/\/(.)\n/";

  protected $delimiter = ",|\n";

  public function add(string $input): int
  {
    $numbers = $this->parseInput($input);
    $result = 0;

    foreach($numbers as $number){
      $number = intval($number);

      if ($number < static::MIN_VALUE){
        throw new OutOfRangeException();
      }

      if ($number > static::MAX_VALUE){
        continue;
      }

      $result += $number;
    }

    return $result;
  }

  private function parseInput(string $input): array
  {
    if (preg_match(self::CUSTOM_DELIMITER_PATTERN, $input, $matches)) {
      $this->delimiter = $matches[1];
      str_replace($matches[0], '', $input);
    }

    return preg_split("/{$this->delimiter}/", $input);
  }
}