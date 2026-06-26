<?php

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../../Kata/Y2026/Q2/RGBToHexConversion.php';
use function Kata\Y2026\Q2\rgb;

class RGBToHexConversionTest extends TestCase
{
	public function testBaseTests()
	{
		// assertEquals(mixed $expected, mixed $actual[, string $message = ''])
		$this->assertSame("FFFFFF", rgb(255, 255, 255));
		$this->assertSame("FFFFFF", rgb(255, 255, 300));
		$this->assertSame("000000", rgb(0, 0, 0));
		$this->assertSame("000000", rgb(-500, 0, 0));
		$this->assertSame("9400D3", rgb(148, 0, 211));
	}
}
