<?php

declare(strict_types=1);

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

https://www.codewars.com/kata/520446778469526ec0000001
*/

namespace Kata\Y2026\Q3;

class NestingStructureComparison
{
    public function output(array $main, array $compare): bool
    {
        return $this->compareSegment($main, $compare);
    }

    private function compareSegment(mixed $segmentMain, mixed $segmentCompare): bool
    {
        if (is_array($segmentMain) !== is_array($segmentCompare)) {
            return false;
        }

        if (is_array($segmentMain) && is_array($segmentCompare)) {
            if (count($segmentMain) !== count($segmentCompare)) {
                return false;
            }

            for ($i = 0; $i < count($segmentMain); $i++) {
                if (!$this->compareSegment(
                    $segmentMain[$i],
                    $segmentCompare[$i]
                )) {
                    return false;
                }
            }
        }

        return true;
    }
}
