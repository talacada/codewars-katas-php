<?php

/*
My little sister came back home from school with the following task: given a squared sheet of paper she has to cut it in pieces which, when assembled, give squares the sides of which form an increasing sequence of numbers. At the beginning it was lot of fun but little by little we were tired of seeing the pile of torn paper. So we decided to write a program that could help us and protects trees.

Task
Given a positive integral number n, return a strictly increasing sequence (list/array/string depending on the language) of numbers, so that the sum of the squares is equal to n².

If there are multiple solutions (and there will be), return as far as possible the result with the largest possible values:

Examples
decompose(11) must return [1,2,4,10]. Note that there are actually two ways to decompose 11², 11² = 121 = 1 + 4 + 16 + 100 = 1² + 2² + 4² + 10² but don't return [2,6,9], since 9 is smaller than 10.

For decompose(50) don't return [1, 1, 4, 9, 49] but [1, 3, 5, 8, 49] since [1, 1, 4, 9, 49] doesn't form a strictly increasing sequence.

Note
Neither [n] nor [1,1,1,…,1] are valid solutions. If no valid solution exists, return nil, null, Nothing, None (depending on the language) or "[]" (C) ,{} (C++), [] (Swift, Go).

The function "decompose" will take a positive integer n and return the decomposition of N = n² as:

[x1 ... xk] or
"x1 ... xk" or
Just [x1 ... xk] or
Some [x1 ... xk] or
{x1 ... xk} or
"[x1,x2, ... ,xk]"
depending on the language (see "Sample tests")

Note for Bash
decompose 50 returns "1,3,5,8,49"
decompose 4  returns "Nothing"
Hint
Very often xk will be n-1.

https://www.codewars.com/kata/54eb33e5bc1a25440d000891
*/

namespace Kata\Y2026\Q4\Sq2Squares;

class Sq2Squares
{
	private int $target;
	private float $targetSqr;

	public static function decompose(int $n): ?array {
		$calculator = new Sq2Squares($n);
		return $calculator->getAllCombinations();
	}

	private function __construct(int $n)
	{
		$this->target = $n;
		$this->targetSqr = $n*$n;
	}

	private function getAllCombinations(): ?array
	{
		$combination = $this->getCombination();

		if ($combination !== null) {
			return $combination->getNumbers();
		}else {
			return null;
		}

	}

	private function getCombination(): ?Combination
	{
		$combination = new Combination();
		$nowBanningIndex = 0;

		do {
			for ($i = $this->target - 1; $i > 0; $i--) {
				$iTimesI = $i*$i;
				if ($iTimesI <= $this->targetSqr - $combination->getSum()) {
					if (!$combination->getIfNumberInCombinationAlready($i)) {
						if (!$combination->getIfCombinationBanned($i)) {
							if ($iTimesI + $combination->getSum() <= $this->targetSqr) {
								$combination->addFromLeft($i);
							}
						}
					}
				}
			}

			if ($combination->getSum() < $this->targetSqr) {
				if (empty($combination->getNumbers())) {
					return null;
				}
				$combination->addBanned();
				$combination->resetNumbers();
			}

		} while ($combination->getSum() != $this->targetSqr);

		return $combination;
	}
}

class Combination
{
	private array $numbers = [];
	private int $sum = 0;
	private array $banned = [];

	public function addFromLeft(int $n) {
		array_unshift($this->numbers, $n);
		$this->addToSum($n*$n);
	}

	public function getNumbers(): array
	{
		return $this->numbers;
	}

	public function getNumberByIndex(int $index): int
	{
		return $this->numbers[$index];
	}

	public function getSum(): int
	{
		return $this->sum;
	}

	public function addToSum(int $n) {
		$this->sum += $n;
	}

	public function addBanned()
	{
		$withoutBanned = $this->removeBanned();
		$this->banned[] = $withoutBanned;
	}

	public function getIfCombinationBanned($next): bool
	{
		$withoutBanned = clone $this;
		$withoutBanned->addFromLeft($next);
		$withoutBanned = $withoutBanned->removeBanned();
		/** @var $banned Combination*/
		foreach ($this->banned as $banned) {
			if ($withoutBanned == $banned) {
				return true;
			}
		}
		return false;
	}

	public function resetNumbers()
	{
		$this->numbers = [];
		$this->sum = 0;
	}

	public function getIfNumberInCombinationAlready(int $i): bool
	{
		$result = in_array($i, $this->numbers);
		if ($result === false) {
			return false;
		}else {
			return true;
		}
	}

	private function removeBanned()
	{
		$newCombination = clone $this;
		$newCombination->banned = [];
		return $newCombination;
	}
}