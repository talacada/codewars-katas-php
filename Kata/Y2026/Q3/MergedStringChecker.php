<?php

declare(strict_types=1);

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
    public array $full;
    public array $part1;
    public array $part2;
    public function __construct(string $full, string $part1, string $part2)
    {
        $this->full = $full === '' ? [] : str_split($full);
        $this->part1 = $part1 === '' ? [] : str_split($part1);
        $this->part2 = $part2 === '' ? [] : str_split($part2);
    }
    public function check(array $full, array $part1, array $part2): bool
    {
        $oneIndex = 0;
        $twoIndex = 0;
        if (count($part1) + count($part2) != count($full)) {
            return false;
        }

        if ($part1 === []) {
            return implode($full) === implode($part2);
        }
        if ($part2 === []) {
            return implode($full) === implode($part1);
        }
        foreach ($full as $index => $fullLetter) {
            if (isset($part1[$oneIndex]) && isset($part2[$twoIndex])) {
                if ($part1[$oneIndex] === $part2[$twoIndex]) {
                    $subfull = str_split(substr(implode("", $full), $index + 1));
                    $subpart1Smaller = str_split(substr(implode("", $part1), $oneIndex + 1));
                    $subpart2Smaller = str_split(substr(implode("", $part2), $twoIndex + 1));
                    $subpart1Normal = str_split(substr(implode("", $part1), $oneIndex));
                    $subpart2Normal = str_split(substr(implode("", $part2), $twoIndex));
                    $resultOne = $this->check($subfull, $subpart1Smaller, $subpart2Normal);
                    $resultTwo = $this->check($subfull, $subpart1Normal, $subpart2Smaller);
                    if ($resultOne || $resultTwo) {
                        return true;
                    }
					return false;
                }
            }
            if (isset($part1[$oneIndex]) && $fullLetter === $part1[$oneIndex]) {
                $oneIndex++;
                continue;
            }
            if (isset($part2[$twoIndex]) && $fullLetter === $part2[$twoIndex]) {
                $twoIndex++;
                continue;
            }
            return false;
        }

        return true;
    }
}
