<?php
/*
DATE 17.04.2026

The rgb function is incomplete. Complete it so that passing in RGB decimal values will result in a hexadecimal representation being returned. Valid decimal values for RGB are 0 - 255. Any values that fall out of that range must be rounded to the closest valid value.

Note: Your answer should always be 6 characters long, the shorthand with 3 will not work here.

Examples (input --> output):
255, 255, 255 --> "FFFFFF"
255, 255, 300 --> "FFFFFF"
0, 0, 0       --> "000000"
148, 0, 211   --> "9400D3"
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function rgb(int $r, int $g, int $b): string
{
	$r = sprintf('%02X', min(max($r, 0), 255));
	$g = sprintf('%02X', min(max($g, 0), 255));
	$b = sprintf('%02X', min(max($b, 0), 255));

	return $r . $g . $b;
}

class RGBToHexConversion extends TestCase
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