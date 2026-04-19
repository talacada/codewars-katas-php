<?php
//Given a positive number n > 1 find the prime factor decomposition of n. The result will be a string with the following form :
//
// "(p1**n1)(p2**n2)...(pk**nk)"
//with the p(i) in increasing order and n(i) empty if n(i) is 1.
//
//Example: n = 86240 should return "(2**5)(5)(7**2)(11)"

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function primeFactors(int $n):string
{
	$used = [];
	$stoppedAt = 0;
	while ($n != 0) {
		$sqrt = sqrt($n);
		if ($stoppedAt != 0) {
			$continueAt = $stoppedAt;
		}else  {
			$continueAt = 2;
		}
		for ($i = $continueAt; $i <= $sqrt; $i = $i + 2) {
			if ($n % $i === 0) {
				$used[] = $i;
				$n = $n / $i;
				$stoppedAt = $i;
				break;
			}
			if ($i === 2) {
				$i--;
			}
		}

		if ($stoppedAt > $sqrt || $i === intval(round($sqrt))) {
			$used[] = $n;
			$n = 0;
		}
	}
	//TODO format return
	return '(2**2)(3**3)(5)(7)(11**2)(17)';
}

class PrimeFactors extends TestCase
{
	private function revTest($actual, $expected): void
	{
		$this->assertSame($expected, $actual);
	}

	public function testBasics()
	{
		$this->revTest(primeFactors(7775460), "(2**2)(3**3)(5)(7)(11**2)(17)");
		$this->revTest(primeFactors(7919), "(7919)");
		$this->revTest(primeFactors(17 * 17 * 93 * 677), "(3)(17**2)(31)(677)");
	}
}