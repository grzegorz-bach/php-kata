<?php

namespace App;

class FizzBuzz
{
  public static function convert(int $number): int|string
  {
    $result = '';

    if (!($number % 3))
    {
      $result .= 'Fizz';
    }

    if (!($number % 5))
    {
      $result .= 'Buzz';
    }

    return $result ?: $number;
  }
}