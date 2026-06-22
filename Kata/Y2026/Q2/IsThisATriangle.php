<?php

/*
Implement a function that accepts 3 integer values a, b, c. The function should return true
if a triangle can be built with the sides of given length and false in any other case.

(In this case, all triangles must have surface greater than 0 to be accepted).

https://www.codewars.com/kata/is-this-a-triangle
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function isTriangle(int $a, int $b, int $c): bool
{
    if ($a + $b <= $c) {
        return false;
    } elseif ($b + $c <= $a) {
        return false;
    } elseif ($a + $c <= $b) {
        return false;
    }
    return true;
}

class IsThisATriangle extends TestCase
{
    public function testBasics(): void
    {
        $this->assertTrue(isTriangle(1, 2, 2));
        $this->assertFalse(isTriangle(1, 2, 3));
        $this->assertFalse(isTriangle(-5, 1, 3));
        $this->assertFalse(isTriangle(0, 2, 3));
        $this->assertFalse(isTriangle(1, 2, 9));
    }
}
