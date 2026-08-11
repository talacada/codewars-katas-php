<?php

declare(strict_types=1);

/*
Snail Sort
Given an n x n array, return the array elements arranged from outermost elements to the middle element, traveling clockwise.

array = [[1,2,3],
         [4,5,6],
         [7,8,9]]
snail(array) #=> [1,2,3,6,9,8,7,4,5]
For better understanding, please follow the numbers of the next array consecutively:

array = [[1,2,3],
         [8,9,4],
         [7,6,5]]
snail(array) #=> [1,2,3,4,5,6,7,8,9]
This image will illustrate things more clearly:


NOTE: The idea is not sort the elements from the lowest value to the highest; the idea is to traverse the 2-d array in a clockwise snailshell pattern.

NOTE 2: The 0x0 (empty matrix) is represented as en empty array inside an array [[]].

https://www.codewars.com/kata/521c2db8ddc89b9b7a0000c1
*/

namespace Kata\Y2026\Q3;

class Snail
{
	private array $matrix;
	private int $topOffset = 0;
	private int $bottomOffset = 0;
	private int $leftOffset = 0;
	private int $rightOffset = 0;
	private int $nowSide = 0;
	private int $direction = 0;

	public function __construct(array $array)
	{
		$this->matrix = $array;
	}
	public function solve():array
	{
		$return = [];

		do {
			if ($this->nowSide === 0) {
				$return[] = $this->getRow();
			} else {
				$return[] = $this->getCol();
			}
		} while (count(...$this->matrix) != count($return));

		return $return;
	}

	private function getRow(): array
	{
		if ($this->direction === 0) {
			$return = array_merge($this->matrix[$this->topOffset]);
			$this->topOffset++;
		}else {
			$return = $this->matrix[$this->bottomOffset];
			$this->bottomOffset++;
		}

		$return = array_slice($return, $this->leftOffset);
		if ($this->rightOffset > 0) {
			$return = array_slice($return, 0, -$this->rightOffset);
		}

			if ($this->direction === 1) {
			$return = array_reverse($return);
		}

		return $return;
	}

	private function getCol(): array
	{

	}
}
