<?php

declare(strict_types=1);

/*

Task
A rectangle with sides equal to even integers a and b is drawn on the Cartesian plane. Its center (the intersection point of its diagonals) coincides with the point (0, 0), but the sides of the rectangle are not parallel to the axes; instead, they are forming 45 degree angles with the axes.

How many points with integer coordinates are located inside the given rectangle (including on its sides)?

Example
For a = 6 and b = 4, the output should be 23

The following picture illustrates the example, and the 23 points are marked green.



Input/Output
[input] integer a

A positive even integer.

Constraints: 2 ≤ a ≤ 10000.

[input] integer b

A positive even integer.

Constraints: 2 ≤ b ≤ 10000.

[output] an integer

The number of inner points with integer coordinates.

https://www.codewars.com/kata/5886e082a836a691340000c3

*/

namespace Kata\Y2026\Q2;

function rectangle_rotation(int $a, int $b): int
{

    $u = (int) floor($a / sqrt(2));
    $v = (int) floor($b / sqrt(2));


    $uEven = intdiv($u, 2) * 2 + 1;
    $uOdd = (2 * $u + 1) - $uEven;

    $vEven = intdiv($v, 2) * 2 + 1;
    $vOdd = (2 * $v + 1) - $vEven;

    return ($uEven * $vEven) + ($uOdd * $vOdd);
}
