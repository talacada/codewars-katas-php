<?php

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
use Kata\Y2026\Q2\ZonkGame;

function getScore(array $dice): int
{
	$game = new ZonkGame($dice);
	return $game->getScore();
}

class ZonkGameTests extends TestCase
{
	private function doTest($dice, $expected, $msg = null)
	{
		$msg = $msg ?: ('Dice=' . json_encode($dice));
		$this->assertSame($expected, getScore($dice), $msg);
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
	}
}
