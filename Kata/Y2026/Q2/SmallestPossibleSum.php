<?php

namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function solution(array $input):int
{
	rsort($input);
	do {
		$changed = false;
		for ($i = 1; $i < count($input); $i++) {
			if ($input[$i - 1] % $input[$i] === 0) {
				continue;
			}elseif ($input[$i] % $input[$i - 1] === 0) {
				$input[$i] = $input[$i - 1];
				$changed = true;
			}else {
				if ($input[$i - 1] > $input[$i]) {
					$input[$i] = $input[$i - 1] % $input[$i];
				}else {
					$input[$i] = $input[$i] % $input[$i - 1];
				}
				$changed = true;
			}
		}
	} while ($changed);

	return min($input) * count($input);
}
class SmallestPossibleSum extends TestCase
{
	public function testExample()
	{
		$this->assertSame(3, solution([10, 15, 21]));
		$this->assertSame(6, solution([18, 12, 8]));
		$this->assertSame(9, solution([6, 9, 21]));
		$this->assertSame(18, solution([18, 3, 3, 3, 3, 3]));
		$this->assertSame(2, solution([10000000000, 1]));
		$this->assertSame(3, solution([1, 21, 55]));
		$this->assertSame(5, solution([3, 13, 23, 7, 83]));
		$this->assertSame(12, solution([4, 16, 24]));
		$this->assertSame(12, solution([30, 12]));
	}
}