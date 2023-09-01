<?php

use App\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{

  /**
   * @test
   */
  public function it_evaluates_an_empty_string_as_0()
  {
    $calculator = new StringCalculator();

    $this->assertSame(0, $calculator->add(''));
  }

  /**
   * @test
   */
  public function it_finds_the_sum_of_a_single_value()
  {
    $calculator = new StringCalculator();

    $this->assertSame(5, $calculator->add('5'));
  }

  /**
   * @test
   */
  public function it_finds_the_sum_of_two_values()
  {
    $calculator = new StringCalculator();

    $this->assertSame(10, $calculator->add('5,5'));
  }

  /**
   * @test
   */
  public function it_finds_the_sum_of_any_ammount_of_values()
  {
    $calculator = new StringCalculator();

    $this->assertSame(32, $calculator->add('5,5,5,5,6,6'));
  }

  /**
   * @test
   */
  public function it_accepts_new_line_as_a_delimiter()
  {
    $calculator = new StringCalculator();

    $this->assertSame(10, $calculator->add("5\n5"));
  }

  /**
   * @test
   */
  public function negative_values_are_not_allowed()
  {
    $calculator = new StringCalculator();

    $this->expectException(Exception::class);

    $calculator->add("5,-4");
  }

  /**
   * @test
   */
  public function values_greater_than_1000_should_be_ignored()
  {
    $calculator = new StringCalculator();

    $this->assertSame(10, $calculator->add("5,1001,5"));
  }

  /**
   * @test
   */
  public function it_supports_custom_delimiters()
  {
    $calculator = new StringCalculator();

    $this->assertSame(10, $calculator->add("//;\n5;5"));
  }
}