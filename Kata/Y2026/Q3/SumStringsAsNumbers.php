<?php

/*
Given the string representations of two integers, return the string representation of the sum of those integers.

For example:

sumStrings('1','2') // => '3'
A string representation of an integer will contain no characters besides the ten numerals "0" to "9".

I have removed the use of BigInteger and BigDecimal in java

Python: your solution need to work with huge numbers (about a milion digits), converting to int will not work.

https://www.codewars.com/kata/5324945e2ece5e1f32000370
*/

namespace Kata\Y2026\Q3\SumStringsAsNumbers;

function sum_strings($a, $b): string
{
	$calculator = new SumStringsAsNumbers();
	return $calculator->result($a, $b);
}

class SumStringsAsNumbers
{
	public function result($a, $b): string
	{
		$bonus = 0;
		$aRev = strrev($a);
		$bRev = strrev($b);
		$final = '';
		$maxLength = max(strlen($a), strlen($b));
		for ($i = 0; $i < $maxLength; $i++) {
			$aNow = (int) substr($aRev, $i, 1);
			$bNow = (int) substr($bRev, $i, 1);
			if ($aNow +  $bNow + $bonus > 9) {
				if ($i === $maxLength - 1) {
					$final .= strrev($aNow + $bNow + $bonus);
				}else {
					$final .= $aNow + $bNow + $bonus - 10;
				}
				if ($bonus != 0) {
					$bonus -= 1;
				}
				$bonus += 1;
			}else {
				$final .= $aNow + $bNow + $bonus;
				if ($bonus != 0) {
					$bonus -= 1;
				}

			}
		}

		return ltrim(strrev($final), "0");
	}
}