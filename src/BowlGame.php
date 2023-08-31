<?php

namespace App;

class BowlGame {

  /**
   * Number of of frames in a game
   */
  const FRAMES_PER_GAME = 10;

  
  /**
   * All rolls for the game
   */
  private array $rolls = [];
  

  /**
   * Roll the ball
   */
  public function roll(int $pins): void
  {
    $this->rolls[] = $pins;
  }


  /**
   * Get number of pins for specific roll
   */
  public function pinCount($roll): int
  {
    return $this->rolls[$roll];
  }


  /**
   * Calculate the final score
   */
  public function score(): int
  {
    $score = 0;
    $roll = 0;

    for($i = 1; $i <= static::FRAMES_PER_GAME; $i++)
    {
      if ($this->isStrike($roll))
      {
        $score += $this->pinCount($roll) + $this->strikeBonus($roll);

        $roll += 1;

        continue;
      }

      $score += $this->regularScore($roll);

      if ($this->isSpare($roll))
      {
        $score += $this->spareBonus($roll);
      }

      $roll += 2;

    }

    return $score;
  }


  /**
   * Determine if the current frame was a spare
   */
  private function isSpare(int $roll): bool
  {
    return $this->regularScore($roll) === 10;
  }


  /**
   * Determine if the current frame was a strike
   */
  private function isStrike(int $roll): bool
  {
    return $this->pinCount($roll) === 10;
  }


  /**
   * Get the regular score for the current frame
   */
  private function regularScore(int $roll): int
  {
    return $this->pinCount($roll) + $this->pinCount($roll + 1);
  }


  /**
   * Get the spare bonus for the current frame
   */
  private function spareBonus(int $roll): int
  {
    return $this->pinCount($roll + 2);
  }


  /**
   * Get the strike bonus for the current frame
   */
  private function strikeBonus(int $roll): int
  {
    return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);
  }
}