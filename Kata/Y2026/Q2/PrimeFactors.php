<?php

/*
Given a positive number n > 1 find the prime factor decomposition of n. The result will be a string with the following form :

 "(p1**n1)(p2**n2)...(pk**nk)"
with the p(i) in increasing order and n(i) empty if n(i) is 1.

Example: n = 86240 should return "(2**5)(5)(7**2)(11)"

https://www.codewars.com/kata/54d512e62a5e54c96200019e
*/

namespace Kata\Y2026\Q2;

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

		if ($stoppedAt > $sqrt || $i === intval(round($sqrt)) || $i > intval(round($sqrt))) {
			$used[] = $n;
			$n = 0;
		}
	}
	$return = '';
	$used = array_count_values($used);

	foreach ($used as $number => $count) {
		if ($count === 1) {
			$return .= '(' . $number . ')';
		}else {
			$return .= '(' . $number . '**' . $count . ')';
		}
	}
	return $return;
}
