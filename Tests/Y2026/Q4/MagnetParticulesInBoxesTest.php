<?php

declare(strict_types=1);

namespace Y2026\Q4;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/MagnetParticulesInBoxes.php';
use function Kata\Y2026\Q4\MagnetParticulesInBoxes\doubles;
class MagnetParticulesInBoxesTest extends TestCase
{
	private function assertFuzzyEquals($actual, $expected): void {
		$inrange = abs($actual - $expected) <= 1e-6;
		if ($inrange == false) {
			echo "Testing at 1e-6 ; Expected value must be $expected but got $actual";
			echo "\r\n";
		}
		$this->assertSame(true, $inrange);
	}
	public function testDoubles(): void {
		$this->assertFuzzyEquals(doubles(1, 10), 0.5580321939764581);
		$this->assertFuzzyEquals(doubles(10, 1000), 0.6921486500921933);
	}
}
