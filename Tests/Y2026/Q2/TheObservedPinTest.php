<?php

namespace Y2026\Q2;

use Kata\Y2026\Q2\TheObservedPin;
use PHPUnit\Framework\TestCase;

function getPINs(string $pin): array
{
	$TheObservedPin = new TheObservedPin($pin);
	return $TheObservedPin->getAllCombinations();
}

class TheObservedPinTest extends TestCase
{
	// test function names should start with "test"
	public function testSample() {
		$expectations = [
			"0" => ["0", "8"],
			"8" => ["5", "7", "8", "9", "0"],
			"11" => ["11", "22", "44", "12", "21", "14", "41", "24", "42"],
			"369" => ["339","366","399","658","636","258","268","669","668","266","369","398","256","296","259","368","638","396","238","356","659","639","666","359","336","299","338","696","269","358","656","698","699","298","236","239"],
		];
		foreach ($expectations as $pin => $expect) {
			$actual = getPINs($pin);
			sort($actual);
			sort($expect);
			$this->assertSame($expect, $actual);
		}
	}
}