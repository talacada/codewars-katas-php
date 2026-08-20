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
	$calculator = new SumStringsAsNumbers($a, $b);
	return $calculator->result();
}

class SumStringsAsNumbers
{
	private Number $a;
	private Number $b;
	private Number $bonus;

	public function __construct($a, $b) {
		$this->a = new Number($a);
		$this->b = new Number($b);
		$this->bonus = new Number(0);
	}
	public function result(): string
	{
		/*$bonus = 0;
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

		return ltrim(strrev($final), "0");*/

		$bonus = new Number(0);
		$result = new Number();

		$maxLength = max($this->a->getLength(), $this->b->getLength());

		for ($i = 0; $i < $maxLength; $i++) {
			$this->getThisIterationResult($i, $maxLength);
		}
	}

	private function getThisIterationResult(int $iteration, int $maxLength): Digit
	{
		$aIntNow = $this->a->getDigitFromBack($iteration)->getDigit();
		$bIntNow = $this->b->getDigitFromBack($iteration)->getDigit();
		$bonusInt = $this->bonus->getNumberAsInt();
		$return = new Digit();

		if ($aIntNow +  $bIntNow + $bonusInt > 9) {
			if ($iteration === $maxLength - 1) {
				$return->setDigit($aIntNow +  $bIntNow + $bonusInt);
			}else {
				$return->setDigit($aIntNow +  $bIntNow + $bonusInt - 10);
			}
			if ($bonusInt != 0) {
				//TODO
				$this->bonus-setNumber($bonusInt - 1);
			}
			//TODO
			$bonus += 1;
		}else {
			//TODO
			$final .= $aNow + $bNow + $bonus;
			if ($bonus != 0) {
				$bonus -= 1;
			}

		}
	}
}

class Number {
	private string $number;
	private array $digits;

	public function __construct(string $number = '') {
		$this->number = $number;
		$digits = str_split($this->number);

		$this->digits = array_map(function (string $char): Digit {
			return new Digit((int) $char);
		}, $digits);
	}

	public function getReversedNumber(): string
	{
		return strrev($this->number);
	}

	public function getDigitFromBack($n): ?Digit {
		return array_reverse($this->digits)[$n];
	}

	public function getNumberAsString(): string
	{
		return $this->number;
	}

	public function getNumberAsInt(): int
	{
		return intval($this->number);
	}

	public function setNumber(string $number): void
	{
		$this->number = $number;
	}

	public function getDigits(): array
	{
		return $this->digits;
	}

	public function setDigits(array $digits): void
	{
		$this->digits = $digits;
	}

	public function getLength(): int
	{
		return strlen($this->number);
	}

}

class Digit
{
	private ?int $digit;

	public function __construct(int $number = null){
		$this->digit = $number;
	}

	public function getDigit(): ?int
	{
		return $this->digit;
	}

	public function setDigit(int $digit): void
	{
		$this->digit = $digit;
	}
}