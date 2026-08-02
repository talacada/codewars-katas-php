<?php

declare(strict_types=1);

/*

If you haven't solved it already I recommend trying this kata first.

Task
Given n representing the number of floors build a penthouse like this:

        ___
       /___\
      /_____\
      |  _  |     1 floor
      |_|_|_|

       _____
      /_____\
     /_______\
    /_________\
   /___________\
   |           |
   |    ___    |     2 floors
   |   |   |   |
   |___|___|___|

      _______
     /_______\
    /_________\
   /___________\
  /_____________\
 /_______________\
/_________________\
|                 |         3 floors
|                 |
|      _____      |
|     |     |     |
|     |     |     |
|_____|_____|_____|
Note: whitespace should be preserved on both sides of the roof. No invalid input tests.

Good luck!

https://www.codewars.com/kata/58360d112fb0ba255300008b
*/

namespace Y2026\Q3\NowThatACrib;

function my_crib(int $n): string
{
    $crib = '';
    $oneThird = ($n * 2) - 1;
    $width = 4 + ($oneThird * 3);
    $roofInnerMargin = $oneThird + 2;
    $roofOuterMargin = ($width - $roofInnerMargin) / 2;
    $roofHeight = $n * 2 + 1;
    //Roof
    for ($roofFloor = $roofHeight; $roofFloor > 0; $roofFloor--) {
        $crib .= str_repeat(' ', $roofOuterMargin);
        if ($roofFloor != $roofHeight) {
            $crib .= '/';
        }

        $crib .= str_repeat('_', $roofInnerMargin);

        if ($roofFloor != $roofHeight) {
            $crib .= '\\';
        }

        $crib .= str_repeat(' ', $roofOuterMargin);

        $crib .= '\n';

        if ($roofFloor != $roofHeight) {
            $roofInnerMargin = $roofInnerMargin + 2;
        }
        $roofOuterMargin = $roofOuterMargin - 1;
    }
    //Body
    for ($floor = ($n * 2) - 1; $floor >= 0; $floor--) {
        $crib .= '|';
        if ($floor != 0) {
            $crib .= str_repeat(' ', $oneThird);
        } else {
            $crib .= str_repeat('_', $oneThird);
        }

        //Door
        if ($floor <= $n) {
            //Top door
            if ($floor === $n) {
                $crib .= ' ';
                $crib .= str_repeat('_', $oneThird);
                $crib .= ' ';
            } elseif ($floor === 0) {
                $crib .= '|';
                $crib .= str_repeat('_', $oneThird);
                $crib .= '|';
            } else {
                $crib .= '|';
                $crib .= str_repeat(' ', $oneThird);
                $crib .= '|';
            }
        } else {
            $crib .= str_repeat(' ', $oneThird + 2);
        }

        if ($floor != 0) {
            $crib .= str_repeat(' ', $oneThird);
        } else {
            $crib .= str_repeat('_', $oneThird);
        }
        $crib .= '|\n';
    }

    return substr($crib, 0, -2);
}
