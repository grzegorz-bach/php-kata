<?php

namespace App;

class TennisMatch
{
  private array $points = [0,0]; // [ player one, player two ]

  public function __construct(
    private readonly string $playerOne = 'Player 1',
    private readonly string $playerTwo = 'Player 2'
  )
  {
    //
  }

  public function score(): string
  {
    $score = '';

    if ($this->hasWinner())
    {
      $score = "Winner: " . $this->getLeader();
    }

    if ($this->hasAdvantage())
    {
      $score = "Advantage: " . $this->getLeader();
    }

    if($this->hasDeuce())
    {
      $score = 'deuce';
    }

    return $score ?: sprintf(
      "%s-%s",
      ...array_map(fn(int $p) => $this->pointsToTerm($p), $this->points)
    );
  }

  public function pointToPlayerOne(): void
  {
    $this->points[0]++;
  }

  public function pointToPlayerTwo(): void
  {
    $this->points[1]++;
  }

  private function hasWinner(): bool
  {
    return max($this->points) > 3 && 
      abs($this->points[0] - $this->points[1]) >= 2;
  }

  private function hasAdvantage(): bool
  {
    return max($this->points) > 3 && 
      abs($this->points[0] - $this->points[1]) === 1;
  }

  private function hasDeuce(): bool
  {
    return max($this->points) >= 3 && 
      abs($this->points[0] - $this->points[1]) === 0;
  }

  private function getLeader(): string
  {
    return [
      $this->playerOne,
      $this->playerTwo
    ][array_keys($this->points, max($this->points))[0]];
  }

  private function pointsToTerm($points): string
  {
    return match($points){
      0 => 'love',
      1 => 'fifteen',
      2 => 'thirty',
      3 => 'forty'
    };
  }
}