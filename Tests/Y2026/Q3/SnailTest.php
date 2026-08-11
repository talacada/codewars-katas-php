<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\Snail;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/Snail.php';

function snail(array $array): array
{
	$snail = new Snail($array);
	return $snail->solve();
}
class SnailTest extends TestCase
{
	public function testDescriptionExamples() {
		$this->assertSame([1, 2, 3, 1, 4, 7, 7, 9, 8, 7, 7, 4, 5, 6, 9, 8], snail([
			[1, 2, 3, 1],
			[4, 5, 6, 4],
			[7, 8, 9, 7],
			[7, 8, 9, 7]
		]));
		$this->assertSame([1, 2, 3, 6, 9, 8, 7, 4, 5], snail([
			[1, 2, 3],
			[4, 5, 6],
			[7, 8, 9]
		]));
		$this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9], snail([
			[1, 2, 3],
			[8, 9, 4],
			[7, 6, 5]
		]));
		$this->assertSame([], snail([[]]), 'Your solution should also work properly for an empty matrix');
	}
}
