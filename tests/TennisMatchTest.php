<?php

use App\TennisMatch;
use PHPUnit\Framework\TestCase;

class TennisMatchTest extends TestCase
{
  /**
   * @test
   * @dataProvider scores
   */
  public function it_scores_a_tennis_match(
    int $playerOnePoints, 
    int $playerTwoPoints, 
    string $score
  )
  {
    $match = new TennisMatch('John', 'Ann');

    for($i = 0; $i < $playerOnePoints; $i++){
      $match->pointToPlayerOne();
    }

    for($i = 0; $i < $playerTwoPoints; $i++){
      $match->pointToPlayerTwo();
    }

    $this->assertEquals($score, $match->score());
  }

  public static function scores(): array
  {
    return [
      [0,0,'love-love'],
      [1,0, 'fifteen-love'],
      [1,1,'fifteen-fifteen'],
      [2,0,'thirty-love'],
      [2,1,'thirty-fifteen'],
      [2,2,'thirty-thirty'],
      [3,0,'forty-love'],
      [3,1,'forty-fifteen'],
      [3,2,'forty-thirty'],
      [3,3,'deuce'],
      [4,3,'Advantage: John'],
      [3,4,'Advantage: Ann'],
      [4,4,'deuce'],
      [5,3,'Winner: John'],
      [3,5,'Winner: Ann']
    ];
  }
}