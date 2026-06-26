<?php
namespace Y2026\Q2;

use Kata\Y2026\Q2\SnakesLadders;
use PHPUnit\Framework\TestCase;

class SnakesLaddersTest extends TestCase
{
	public function testExample()
	{
		$game = new SnakesLadders();
		$this->assertSame("Player 1 is on square 38", $game->play(1, 1), "Should return: 'Player 1 is on square 38'");
		$this->assertSame("Player 1 is on square 44", $game->play(1, 5), "Should return: 'Player 1 is on square 44'");
		$this->assertSame("Player 2 is on square 31", $game->play(6, 2), "Should return: 'Player 2 is on square 31'");
		$this->assertSame("Player 1 is on square 25", $game->play(1, 1), "Should return: 'Player 1 is on square 25'");
	}
}