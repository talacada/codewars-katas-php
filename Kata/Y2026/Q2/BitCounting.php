<?php

declare(strict_types=1);

/*
Write a function that takes an integer as input, and returns the number of bits that are
equal to one in the binary representation of that number. You can guarantee that input
is non-negative.

Example: The binary representation of 1234 is 10011010010, so the function should
return 5 in this case.

https://www.codewars.com/kata/bit-counting
*/

namespace Kata\Y2026\Q2;

function countBits(int $n): int
{
    return count(array_filter(str_split((string) decbin($n))));
}
