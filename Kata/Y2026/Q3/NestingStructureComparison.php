<?php

/*

Complete the function/method (depending on the language) to return true/True when its argument is an array that has the same nesting structures and same corresponding length of nested arrays as the first array.

For example:

same_structure_as([1, 1, 1], [2, 2, 2]); // => true
same_structure_as([1, [1, 1]], [2, [2, 2]]); // => true
same_structure_as([1, [1, 1]], [[2, 2], 2]); // => false
same_structure_as([1, [1, 1]], [[2], 2]); // => false
same_structure_as([[[], []]], [[[], []]]); // => true
same_structure_as([[[], []]], [[1, 1]]); // => false
You may assume that all arrays passed in will be non-associative.

*/

namespace Kata\Y2026\Q3;

class NestingStructureComparison
{
	public function output($main, $compare): bool
	{
		return $this->compareSegment($main, $compare);
	}

	private function compareSegment(mixed $segmentMain, mixed $segmentCompare): bool
	{
		if((is_array($segmentMain) && is_array($segmentMain) === is_array($segmentCompare))) {
			for ($i = 0; $i < count($segmentMain); $i++) {
				if ((is_array($segmentMain[$i]) && is_array($segmentMain[$i]) === is_array($segmentCompare[$i]))) {
					for ($y = 0; $y < count($segmentMain[$i]); $y++) {
						$this->compareSegment($segmentMain[$i][$y], $segmentCompare[$i][$y]);
					}
				}elseif (is_numeric($segmentMain[$i]) && is_numeric($segmentMain[$i]) === is_numeric($segmentCompare[$i])){
					continue;
				}
				else {
					return false;
				}
			}
		}elseif (is_numeric($segmentMain) && is_numeric($segmentMain) === is_numeric($segmentCompare)) {
			$t = 1;
		}
		else {
			return false;
		}

		return true;
	}
}