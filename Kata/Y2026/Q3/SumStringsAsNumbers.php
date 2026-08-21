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
		$result = new Number();

		$maxLength = max($this->a->getLength(), $this->b->getLength());

		for ($i = 0; $i < $maxLength; $i++) {
			$result->addDigit($this->getThisIterationResult($i, $maxLength));
		}

		return ltrim($result->getDigitsReversedAsString(), 0);
	}

	private function getThisIterationResult(int $iteration, int $maxLength): Digit
	{
		$aIntNow = $this->a->getDigitFromBack($iteration) !== null ? $this->a->getDigitFromBack($iteration)->getDigit() : null;
		$bIntNow = $this->b->getDigitFromBack($iteration) !== null ? $this->b->getDigitFromBack($iteration)->getDigit() : null;
		$bonusInt = $this->bonus->getNumberAsInt();
		$return = new Digit();

		if ($aIntNow +  $bIntNow + $bonusInt > 9) {
			if ($iteration === $maxLength - 1) {
				$return->setDigit($aIntNow +  $bIntNow + $bonusInt);
			}else {
				$return->setDigit($aIntNow +  $bIntNow + $bonusInt - 10);
			}
			if ($bonusInt != 0) {
				$bonusInt --;
			}
			$this->bonus = new Number((string) ($bonusInt + 1));
		}else {
			$return->setDigit($aIntNow +  $bIntNow + $bonusInt);
			if ($bonusInt != 0) {
				$this->bonus = new Number((string) ($bonusInt - 1));
			}
		}

		return $return;
	}
}

class Number {
	private string $number;
	private array $digits;

	public function __construct(string $number = '') {
		$this->number = $number;
		$digits = str_split($this->number);

		if ($number === '') {
			return;
		}

		$this->digits = array_map(function (string $char): Digit {
			return new Digit((int) $char);
		}, $digits);
	}

	public function getDigitFromBack($n): ?Digit {
		return array_reverse($this->digits)[$n] ?? null;
	}

	public function getNumberAsInt(): int
	{
		return intval($this->number);
	}

	public function getLength(): int
	{
		return strlen($this->number);
	}

	public function addDigit(Digit $digit): void
	{
		$this->digits[] = $digit;
	}

	public function getDigitsReversedAsString(): string
	{
		$digits = array_reverse($this->digits);
		$result = '';

		foreach ($digits as $digit) {
			$result .= $digit->getDigit();
		}

		return $result;
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