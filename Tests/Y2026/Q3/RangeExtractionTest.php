<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\RangeExtraction;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/RangeExtraction.php';

class RangeExtractionTest extends TestCase
{
	private function solution(array $array): string
	{
		$orderer = new RangeExtraction();
		return $orderer->getString();
	}
	/**
	 * @test
	 */
	public function example(): void
	{
		self::assertSame(
			'-6,-3-1,3-5,7-11,14,15,17-20',
			$this->solution([-6, -3, -2, -1, 0, 1, 3, 4, 5, 7, 8, 9, 10, 11, 14, 15, 17, 18, 19, 20])
		);
	}
}
