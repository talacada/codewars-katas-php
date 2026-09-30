<?php

declare(strict_types=1);

namespace Y2026\Q3\SumByFactors;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/SumByFactors.php';
use function Kata\Y2026\Q3\SumByFactors\sumOfDivided;
class NewKataTest extends TestCase
{
	private function revTest($actual, $expected) {
		$this->assertSame($expected, $actual);
	}
	public function testBasics() {
		$this->revTest(sumOfDivided([12, 15]), [ [2, 12], [3, 27], [5, 15] ]);
		$this->revTest(sumOfDivided([15,21,24,30,45]), [ [2, 54], [3, 135], [5, 90], [7, 21] ]);
		$this->revTest(sumOfDivided([15,21,24,30,-45]), [ [2, 54], [3, 45], [5, 0], [7, 21] ]);
	}
}
