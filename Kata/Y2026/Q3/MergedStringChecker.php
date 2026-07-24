<?php

/*
At a job interview, you are challenged to write an algorithm to check if a given string, s, can be formed from two other strings, part1 and part2.

The restriction is that the characters in part1 and part2 should be in the same order as in s.

The interviewer gives you the following example and tells you to figure out the rest from the given test cases.

For example:

'codewars' is a merge from 'cdw' and 'oears':

    s:  c o d e w a r s   = codewars
part1:  c   d   w         = cdw
part2:    o   e   a r s   = oears

https://www.codewars.com/kata/54c9fcad28ec4c6e680011aa

*/

namespace Kata\Y2026\Q3;

class MergedStringChecker
{

	private array $full;
	private array $part1;
	private array $part2;
	public function __construct(string $full, string $part1, string $part2)
	{
		$this->full = str_split($full);
		$this->part1 = str_split($part1);
		$this->part2 = str_split($part2);
	}
	public function check():bool
	{
		$oneIndex = 0;
		$twoIndex = 0;
		if (count($this->part1) + count($this->part2) != count($this->full)) {
			return false;
		}
		foreach ($this->full as $fullLetter) {
			//todo - if letter same try both, recursion
			if (isset($this->part1[$oneIndex]) && $fullLetter === $this->part1[$oneIndex]) {
				$oneIndex++;
				continue;
			}
			if (isset($this->part2[$twoIndex]) && $fullLetter === $this->part2[$twoIndex]) {
				$twoIndex++;
				continue;
			}
			return false;
		}

		return true;
	}
}