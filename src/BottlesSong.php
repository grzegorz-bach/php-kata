<?php

namespace App;

class BottlesSong
{
  public function sing()
  {
    return $this->verses(99, 0);
  }

  public function verses($start, $end)
  {
    return implode("\n", array_map(
      fn ($number) => $this->verse($number),
      range($start, $end)
    ));
  }

  public function verse(int $number): string
  {
    return match ($number) {
      2 => "2 bottles of beer on the wall\n" .
        "2 bottles of beer\n" .
        "Take one down and pass it around\n" .
        "1 bottle of beer on the wall\n",
      1 => "1 bottle of beer on the wall\n" .
        "1 bottle of beer\n" .
        "Take one down and pass it around\n" .
        "No more bottles of beer on the wall\n",
      0 => "No more bottles of beer on the wall\n" .
        "No more bottles of beer\n" .
        "Go to the store and buy some more\n" .
        "99 bottles of beer on the wall\n",
      default => "$number bottles of beer on the wall\n" .
        "$number bottles of beer\n" .
        "Take one down and pass it around\n" .
        ($number - 1) . " bottles of beer on the wall\n"
    };
  }
}
