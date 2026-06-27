<?php

declare(strict_types=1);

/*
If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9.
The sum of these multiples is 23.

Finish the solution so that it returns the sum of all the multiples of 3 or 5 below the
number passed in.

Note: If the number is a multiple of both 3 and 5, only count it once.

https://www.codewars.com/kata/multiples-of-3-or-5
*/

namespace Kata\Y2026\Q2;

function solutionMultiples(int $input): int
{
    if ($input < 1) {
        return 0;
    }
    $number = 0;
    for ($i = 1; $i <= $input - 1; $i++) {
        if ($i % 3 === 0) {
            $number += $i;
        } elseif ($i % 5 === 0) {
            $number += $i;
        }
    }

    return $number;
}
