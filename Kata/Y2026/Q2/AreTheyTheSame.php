<?php

/*
Given two arrays a and b write a function comp(a, b) that checks whether the two arrays have
the "same" elements, with the same multiplicities (the multiplicity of a member is the number
of times it appears). "Same" means, here, that the elements in b are the elements in a squared,
regardless of the order.

Examples:
- a = [121, 144, 19, 161, 19, 144, 19, 11]
  b = [121, 14641, 20736, 361, 25921, 361, 20736, 361]
  comp(a, b) returns true because in b 121 is the square of 11, 14641 is the square of 121,
  20736 the square of 144, 361 the square of 19, 25921 the square of 161, and so on.

If a or b are nil (or null or None), the problem doesn't make sense so return false.

https://www.codewars.com/kata/are-they-the-same
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function comp(?array $a, ?array $b): bool
{
    if ($a === null || $b === null) {
        return false;
    }
    foreach ($a as $num) {
        $index = array_search($num * $num, $b);
        if ($index === false) {
            return false;
        } else {
            unset($b[$index]);
        }
    }
    return true;
}

class AreTheyTheSame extends TestCase
{
    public function testBasics(): void
    {
        $a1 = [121, 144, 19, 161, 19, 144, 19, 11];
        $a2 = [11*11, 121*121, 144*144, 19*19, 161*161, 19*19, 144*144, 19*19];
        $this->assertTrue(comp($a1, $a2));
    }

    public function testNull(): void
    {
        $this->assertFalse(comp(null, [1, 2, 3]));
        $this->assertFalse(comp([1, 2, 3], null));
    }
}
