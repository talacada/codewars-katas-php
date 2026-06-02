<?php

namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

/*
function solution($input):int
{
	rsort($input);
	do {
		$changed = false;
		for ($i = 0; $i < count($input); ++$i) {
			if (isset($input[$i+1]) && $input[$i] > $input[$i+1]) {
				$input[$i] = $input[$i] - $input[$i+1];
				$changed = true;
				rsort($input);
				break;
			}
		}
	}while ($changed);
	return array_sum($input);
}
*/
/*
function solution($input):int
{
	rsort($input);
	do {
		$changed = false;
		$unique = array_values(array_unique($input));
		if (isset($unique[1]) && $unique[0] > $unique[1]) {
			$input[0] = $unique[0] - $unique[1];
			$changed = true;
			rsort($input);
		}
	}while ($changed);
	return array_sum($input);
}
*/
/*
function solution($input):int
{
	rsort($input);
	do {
		$changed = false;
		$unique = array_values(array_unique($input));
		if (isset($unique[1]) && $unique[0] > $unique[1]) {
			if ($unique[0] % $unique[1] != 0) {
				$input[0] = $unique[0] % $unique[1];
			}else {
				$input[0] = $unique[0] - $unique[1];
			}
			$changed = true;
			rsort($input);
		}
	}while ($changed);
	return array_sum($input);
}
*/
//TODO udelat to pres foreach a ten modulus v nem pro vsechny mezi vsemi.
function solution($input):int
{
	rsort($input);
	do {
		$changed = false;
		$unique = array_values(array_unique($input));
		if (isset($unique[1]) && $unique[0] > $unique[1]) {
			if (($unique[0] % $unique[1]) === 0) {
				$input[0] = $unique[1];
			}else {
				$input[0] = $unique[0] % $unique[1];
			}
			$changed = true;
			rsort($input);
		}
	}while ($changed);
	return array_sum($input);
}
class SmallestPossibleSum extends TestCase
{
	public function testExample()
	{
		$this->assertSame(9, solution([6, 9, 21]));
		$this->assertSame(18, solution([18, 3, 3, 3, 3, 3]));
		$this->assertSame(2, solution([10000000000, 1]));
		$this->assertSame(3, solution([1, 21, 55]));
		$this->assertSame(5, solution([3, 13, 23, 7, 83]));
		$this->assertSame(12, solution([4, 16, 24]));
		$this->assertSame(12, solution([30, 12]));
	}
}