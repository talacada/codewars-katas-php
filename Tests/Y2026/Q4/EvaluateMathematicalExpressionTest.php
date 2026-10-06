<?php

declare(strict_types=1);

namespace Y2026\Q4\EvaluateMathematicalExpression;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/EvaluateMathematicalExpression.php';
use function Kata\Y2026\Q4\EvaluateMathematicalExpression\calc;

class EvaluateMathematicalExpressionTest extends TestCase
{
	protected function randomize(array $a): array {
		for ($i = 0; $i < 2 * count($a); $i++) list($a[$j], $a[$k]) = [$a[$k = array_rand($a)], $a[$j = array_rand($a)]];
		return $a;
	}
	public function testShuffledExamples() {
		foreach ($this->randomize([
			['1+1', 2.0],
			['1 - 1', 0.0],
			['1* 1', 1.0],
			['1 /1', 1.0],
			['-123', -123.0],
			['123', 123.0],
			['2 /2+3 * 4.75- -6', 21.25],
			['12* 123', 1476.0],
			['2 / (2 + 3) * 4.33 - -6', 7.732],
		]) as $a) $this->assertSame($a[1], calc($a[0]));
	}
}
