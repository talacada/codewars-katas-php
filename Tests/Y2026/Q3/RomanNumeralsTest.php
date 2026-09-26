<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\RomanNumerals;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/RomanNumerals.php';

class RomanNumeralsTest extends TestCase
{
	private function doTest($expected, $actual, $input, $functionName): void
	{
		$this->assertSame($expected,
			$actual,
			$functionName . "(" . $input . ") should return " . $expected . ".");
	}

	/** @dataProvider toRomanFixedTestDataProvider */
	public function testToRomanFixed($expected, $input, $method) {
		$actual = RomanNumerals::$method($input);
		$this->doTest($expected, $actual, $input, $method);
	}

	/** @dataProvider fromRomanFixedTestDataProvider */
	public function testFromRomanFixed($expected, $input, $method) {
		$actual = RomanNumerals::$method($input);
		$this->doTest($expected, $actual, $input, $method);
	}

	public static function toRomanFixedTestDataProvider(): array
	{
		return [
			"input:438"    => ["CDXXXVIII",  438, "toRoman"],
			"input:1000"    => ["M",  1000, "toRoman"],
			"input:4"       => ["IV", 4, "toRoman"],
			"input:1"       => ["I", 1, "toRoman"],
			"input:1990"    => ["MCMXC", 1990, "toRoman"],
			"input:2008"    => ["MMVIII", 2008, "toRoman"]
		];
	}

	public static function fromRomanFixedTestDataProvider(): array
	{
		return [
			"input:XXI"     => [21, "XXI", "fromRoman"],
			"input:I"       => [1, "I", "fromRoman"],
			"input:IV"      => [4, "IV", "fromRoman"],
			"input:MMVIII"  => [2008, "MMVIII", "fromRoman"],
			"input:MDCLXVI" => [1666, "MDCLXVI", "fromRoman"]
		];
	}
}
