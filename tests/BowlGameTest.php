<?php

use App\BowlGame;
use PHPUnit\Framework\TestCase;

class BowlGameTest extends TestCase
{
  /**
   * @test
   */
  public function it_scores_a_gutter_game_as_zero()
  {
    $game = new BowlGame();

    foreach(range(1,20) as $roll){
      $game->roll(0);
    }

    $this->assertEquals(0, $game->score());
  }

  /**
   * @test
   */
  public function it_scores_all_ones()
  {
    $game = new BowlGame();

    foreach(range(1,20) as $roll){
      $game->roll(1);
    }

    $this->assertEquals(20, $game->score());
  }

  /**
   * @test
   */
  public function it_awards_a_roll_bonus_for_every_spare()
  {
    $game = new BowlGame();

    $game->roll(5);
    $game->roll(5); //Spare!!

    $game->roll(8);

    foreach(range(1,17) as $roll){
      $game->roll(0);
    }

    $this->assertEquals(26, $game->score());
  }

  /**
   * @test
   */
  public function it_awards_a_two_roll_bonus_for_every_strike()
  {
    $game = new BowlGame();

    $game->roll(10); //Strike!!

    $game->roll(5);
    $game->roll(8);

    foreach(range(1,17) as $roll){
      $game->roll(0);
    }

    $this->assertEquals(36, $game->score());
  }

  /**
   * @test
   */
  public function a_spare_on_the_final_frame_grants_extra_ball()
  {
    $game = new BowlGame();

    foreach(range(1,18) as $roll){
      $game->roll(0);
    }

    $game->roll(5);
    $game->roll(5); //Spare!!

    $game->roll(5);

    $this->assertEquals(15, $game->score());
  }

  /**
   * @test
   */
  public function a_strike_on_the_final_frame_grants_two_extra_balls()
  {
    $game = new BowlGame();

    foreach(range(1,18) as $roll){
      $game->roll(0);
    }

    $game->roll(10); //Strike!!

    $game->roll(10); 
    $game->roll(10);

    $this->assertEquals(30, $game->score());
  }

  /**
   * @test
   */
  public function it_scores_a_perfect_game()
  {
    $game = new BowlGame();

    foreach(range(1,12) as $roll){
      $game->roll(10);
    }

    $this->assertEquals(300, $game->score());
  }
}