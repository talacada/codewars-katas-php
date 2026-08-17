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

/*

count it like two numbers under each other like in school math, cause int has 15 characters than overflow....

*/
function sum_strings($a, $b): string
{
	$bonus = 0;
	$aRev = strrev($a);
	$bRev = strrev($b);
	$final = '';
	for ($i = 0; $i < max(strlen($a), strlen($b)); $i++) {
		$aNow = (int) substr($aRev, $i, 1);
		$bNow = (int) substr($bRev, $i, 1);
		if ($aNow +  $bNow + $bonus > 9) {
			$final .= $aNow + $bNow + $bonus - 10;
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

	return strrev($final);
}

class SumStringsAsNumbers
{

}