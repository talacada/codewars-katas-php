<?php

/*
Consider a sequence u where u is defined as follows:

The number u(0) = 1 is the first one in u.
For each x in u, then y = 2 * x + 1 and z = 3 * x + 1 must be in u too.
There are no other numbers in u.
Ex: u = [1, 3, 4, 7, 9, 10, 13, 15, 19, 21, 22, 27, ...]

1 gives 3 and 4, then 3 gives 7 and 10, 4 gives 9 and 13, then 7 gives 15 and 22 and so on...

Task:
Given parameter n the function dbl_linear (or dblLinear...) returns the element u(n) of the ordered (with <) sequence u (so, there are no duplicates).

Example:
dbl_linear(10) should return 22

Note:
Focus attention on efficiency

https://www.codewars.com/kata/5672682212c8ecf83e000050
*/
namespace Kata\Y2026\Q3\TwiceLinear;


/*
Returning one number as requested index $u.
But that array
- cant have duplicities
- must be ordered ASC

*/
function dblLinear(int $u):int {
	$calculator = new TwiceLinear($u);
	return $calculator->getResult();
}

class TwiceLinear
{
	private int $requestedIndex;
	private array $sequence;

	public function __construct(int $u){
		$this->requestedIndex = $u;
		$this->sequence[1] = new Number(1);
	}

	public function getResult(): int
	{
		$this->generateSequence();
		return $this->sequence[array_key_last($this->sequence)]->getNumber();
	}

	private function generateSequence(): void
	{
		$haveEnoughNumbers = false;
		while ($haveEnoughNumbers === false) {
			foreach ($this->sequence as $number) {
				if ($number->isLoopedOver() === false) {
					$y = $this->calculate($number, 2);
					$z = $this->calculate($number, 3);
					if (!isset($this->sequence[$y])) {
						$this->sequence[$y] = new Number($y);
					}
					if (!isset($this->sequence[$z])) {
						$this->sequence[$z] = new Number($z);
					}
					$number->setLoopedOver(true);
				}
			}

			//TODO this is not effective
			ksort($this->sequence);
			if ($this->requestedIndex <= count($this->sequence)) {
				$allTested = true;
				foreach (array_slice($this->sequence, 0, $this->requestedIndex) as $number) {
					if ($number->isLoopedOver() === false) {
						$allTested = false;
					}
				}

				if ($allTested === true) {
					$haveEnoughNumbers = true;
				}

			}
		}

		ksort($this->sequence);
		$this->sequence = array_slice($this->sequence, 0, $this->requestedIndex + 1, true);
	}

	private function calculate(Number $number, int $multiplier): int
	{
		return $number->getNumber() * $multiplier + 1;
	}
}

class Number {
	private int $number;
	private bool $loopedOver = false;

	public function __construct(int $number){
		$this->number = $number;
	}

	public function getNumber(): int
	{
		return $this->number;
	}

	public function setNumber(int $number): void
	{
		$this->number = $number;
	}

	public function isLoopedOver(): bool
	{
		return $this->loopedOver;
	}

	public function setLoopedOver(bool $loopedOver): void
	{
		$this->loopedOver = $loopedOver;
	}


}