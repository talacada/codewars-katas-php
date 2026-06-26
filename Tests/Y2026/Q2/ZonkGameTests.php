<?php
namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
use Kata\Y2026\Q2\ZonkGame;


class ZonkGameTests extends TestCase
{
	private function doTest($dice, $expected, $msg = null)
	{
		$msg = $msg ?: ('Dice=' . json_encode($dice));
		$game = new ZonkGame($dice);
		$this->assertSame($expected, $game->getScore(), $msg);
	}
	public function testSingleDie()
	{
		$this->doTest([1], 100);
		$this->doTest([2], 0);
		$this->doTest([3], 0);
		$this->doTest([4], 0);
		$this->doTest([5], 50);
		$this->doTest([6], 0);
	}
	public function testMultipleDice()
	{
		$this->doTest([1,1], 200);
		$this->doTest([1,1,1], 1000);
		$this->doTest([1,2,3,4,5,6], 1000);
		$this->doTest([2,2,3,3,6,6], 750);
		$this->doTest([3,2,6,4,4,6], 0);
		$this->doTest([3,3,3,3], 600);
		$this->doTest([2,2,2,2], 400);
		$this->doTest([5,5,5,5], 1000);
		$this->doTest([6,6,6,6,6], 1800);
		$this->doTest([1,1,1,1,1], 3000);
		$this->doTest([1,1,1,5,5], 1100);
		$this->doTest([2,2,2,5,5], 300);
		$this->doTest([1,1,1,2,2,2], 1200);
		$this->doTest([2,2,6,6,2,2], 400);
		$this->doTest([1,1,2,2,3,3], 750);
		$this->doTest([1,1,1,2,2,3], 1000);
		$this->doTest([1,1,1,1,1,5], 3050);
	}
}
