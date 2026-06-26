<?php

declare(strict_types=1);

/*
You are given an array (which will have a length of at least 3, but could be very large)
containing integers. The array is either entirely comprised of odd integers or entirely
comprised of even integers except for a single integer N. Write a method that takes the
array as an argument and returns this "outlier" N.

Examples:
[2, 4, 0, 100, 4, 11, 2602, 36] --> 11 (the only odd number)
[160, 3, 1719, 19, 11, 13, -21] --> 160 (the only even number)

https://www.codewars.com/kata/find-the-parity-outlier
*/

namespace Kata\Y2026\Q2;

function find($integers)
{
    $even = 0;
    $odd = 0;
    foreach ($integers as $inte) {
        if ($inte % 2 === 0) {
            $even++;
            $finalEvenNum = $inte;
        } else {
            $odd++;
            $finalOddNum = $inte;
        }
    }

    switch ($odd) {
        case 1:
            return $finalOddNum;
        default:
            return $finalEvenNum;
    }
}
