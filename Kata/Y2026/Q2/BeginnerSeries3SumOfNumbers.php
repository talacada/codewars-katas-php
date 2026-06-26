<?php

/*
Given two integers a and b, which can be positive or negative, find the sum of all the
integers between and including them and return it. If the two numbers are equal return a or b.

Note: a and b are not ordered!

Examples (a, b) --> output:
(1, 0) --> 1
(1, 2) --> 3
(0, 1) --> 1
(1, 1) --> 1
(-1, 0) --> -1
(-1, 2) --> 2

https://www.codewars.com/kata/beginner-series-number-3-sum-of-numbers
*/

namespace Kata\Y2026\Q2;

function getSum(int $a, int $b): int
{
    if ($a === $b) {
        return $a;
    }

    if ($a > $b) {
        $lower = $b;
        $higher = $a;
    } else {
        $lower = $a;
        $higher = $b;
    }
    $final = 0;

    for ($i = $lower; $i <= $higher; $i++) {
        $final += $i;
    }

    return $final;
}
