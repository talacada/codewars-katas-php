<?php

declare(strict_types=1);

namespace Y2026\Q3\StringsMix;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/StringsMix.php';

use function Kata\Y2026\Q3\StringsMix\mix;
class StringsMixTest extends TestCase
{
	private function revTest($actual, $expected) {
		$this->assertSame($expected, $actual);
	}
	public function testCountOnesBasics() {
		$this->revTest(mix("Are they here", "yes, they are here"), "2:eeeee/2:yy/=:hh/=:rr");
		$this->revTest(mix("looping is fun but dangerous", "less dangerous than coding"), "1:ooo/1:uuu/2:sss/=:nnn/1:ii/2:aa/2:dd/2:ee/=:gg");
		$this->revTest(mix(" In many languages", " there's a pair of functions"), "1:aaa/1:nnn/1:gg/2:ee/2:ff/2:ii/2:oo/2:rr/2:ss/2:tt");
	}
}
