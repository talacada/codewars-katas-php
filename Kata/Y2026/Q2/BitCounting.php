<?php

/*
Write a function that takes an integer as input, and returns the number of bits that are
equal to one in the binary representation of that number. You can guarantee that input
is non-negative.

Example: The binary representation of 1234 is 10011010010, so the function should
return 5 in this case.

https://www.codewars.com/kata/bit-counting
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function countBits(int $n): int
{
    return count(array_filter(str_split((string) decbin($n))));
}

class BitCounting extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(0, countBits(0));
        $this->assertSame(1, countBits(4));
        $this->assertSame(3, countBits(7));
        $this->assertSame(2, countBits(9));
        $this->assertSame(2, countBits(10));
        $this->assertSame(5, countBits(1234));
    }
}
