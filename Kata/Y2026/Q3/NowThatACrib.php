<?php

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

namespace Y2026\Q3;

function my_crib(int $n): string {
	$crib = '';
	//TODO this is wrong
	$width = 4 + ($n - 1) *2;
	$roofInnerMargin = 3 + ($n - 1) * 2;
	$roofOuterMargin = $width - $roofInnerMargin;
	//Roof
	for ($roofFloor = $n; $roofFloor >= 0; $roofFloor--) {
		$crib .= str_repeat(' ', $roofOuterMargin);
		if ($roofFloor != $n) {
			$crib .= '/';
		}

		$crib .= str_repeat('_', $roofInnerMargin + $roofFloor * 2);

		if ($roofFloor != $n) {
			$crib .= '\\';
		}

		$crib .= str_repeat(' ', $roofOuterMargin);

		$crib .= '\n';

		$roofInnerMargin++;
		$roofOuterMargin--;
	}
	//Body
	for ($floor = $n; $floor > 0; $floor--) {
		$crib .= '|';
		if ($floor === 1) {
			$crib .= str_repeat('_', $n * 2);
		} else {
			$crib .= str_repeat(' ', $n * 2);
		}
		$crib .= '|\n';
	}

	return rtrim($crib, "\\n");
}