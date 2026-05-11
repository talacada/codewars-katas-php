<?php

namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

/*

Create a function that takes a positive integer and returns the next bigger number that can be formed by rearranging its digits. For example:

  12 ==> 21
 513 ==> 531
2017 ==> 2071
If the digits can't be rearranged to form a bigger number, return -1 (or nil in Swift, None in Rust):

  9 ==> -1
111 ==> -1
531 ==> -1


*/

function nextBigger(int $n):int
{
	$digits = str_split( (string)($n));
	if (count(array_unique($digits)) === 1) {
		return -1;
	}

	//TODO vybiram úplně špatná čísla, viz obrázek. Musím vybrat to co má nejnižší $j.
	for ($i = count($digits) - 1; $i > -1; $i--) {
		for ($j = $i - 1; $j > -1; $j--) {
			if ($digits[$i] > $digits[$j]) {
				$biggerNumber = $digits;
				$biggerNumber[$j] =  $digits[$i];
				$biggerNumber[$i] = $digits[$j];
				$left = array_slice($biggerNumber, 0, $j + 1);
				$right = array_slice($biggerNumber, $j + 1);
				sort($right);
				$final = array_merge($left, $right);
				return (int) implode('', $final);
			}
		}
	}

	return -1;
}

class NextBiggerNumber extends TestCase
{
	public function testBasicTests()
	{
		//$this->assertSame(21, nextBigger(12));
		//$this->assertSame(531, nextBigger(513));
		//$this->assertSame(2071, nextBigger(2017));
		//$this->assertSame(441, nextBigger(414));
		//$this->assertSame(414, nextBigger(144));
		//$this->assertSame(123456798, nextBigger(123456789));
		//$this->assertSame(1234567908, nextBigger(1234567890));
		//$this->assertSame(-1, nextBigger(9876543210));
		//$this->assertSame(-1, nextBigger(9999999999));
		$this->assertSame(59884848483559, nextBigger(59884848459853));
	}
}

