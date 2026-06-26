<?php

namespace Kata\Y2026\Q2;


/*

Create a function that takes a positive integer and returns the next bigger number that can be formed by rearranging its digits. For example:

  12 ==> 21
 513 ==> 531
2017 ==> 2071
If the digits can't be rearranged to form a bigger number, return -1 (or nil in Swift, None in Rust):

  9 ==> -1
111 ==> -1
531 ==> -1

https://www.codewars.com/kata/55983863da40caa2c900004e
*/

function nextBigger(int $n):int
{
	$digits = str_split( (string)($n));
	$digitsCount = count($digits);

	for ($pivotIndex = $digitsCount - 2; $pivotIndex > -1; $pivotIndex--) {
		for ($swapIndex = $digitsCount - 1; $swapIndex > $pivotIndex; $swapIndex--) {
			if ($digits[$swapIndex] > $digits[$pivotIndex]) {
				$biggerNumber = $digits;
				$biggerNumber[$pivotIndex] =  $digits[$swapIndex];
				$biggerNumber[$swapIndex] = $digits[$pivotIndex];
				$left = array_slice($biggerNumber, 0, $pivotIndex + 1);
				$right = array_slice($biggerNumber, $pivotIndex + 1);
				sort($right);
				$final = array_merge($left, $right);
				return (int) implode('', $final);
			}
		}
	}
	return -1;
}
