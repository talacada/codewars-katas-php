<?php

/*
Task
Your task is to escape from the carpark using only the staircases provided to reach the exit. You may not jump over the edge of the levels (you’re not Superman!) and the exit is always on the far right of the ground floor.
Rules
1. You are passed the carpark data as an argument into the function.
2. Free carparking spaces are represented by a 0
3. Staircases are represented by a 1
4. Your parking place (start position) is represented by a 2 which could be on any floor.
5. The exit is always the far right element of the ground floor.
6. You must use the staircases to go down a level.
7. You will never start on a staircase.
8. The start level may be any level of the car park.
9. Each floor will have only one staircase apart from the ground floor which will not have any staircases.

Returns
Return an array of the quickest route out of the carpark
R1 = Move Right one parking space.
L1 = Move Left one parking space.
D1 = Move Down one level.
Example
Initialise
carpark = [[1, 0, 0, 0, 2],
           [0, 0, 0, 0, 0]]
Working Out
- You start in the most far right position on level 1
- You have to move Left 4 places to reach the staircase => "L4"
- You then go down one flight of stairs => "D1"
- To escape you have to move Right 4 places => "R4"
Result
result = ["L4", "D1", "R4"]
Good luck and enjoy!

https://www.codewars.com/kata/591eab1d192fe0435e000014
*/


namespace Kata\Y2026\Q2;

function escape(array $carpark): array
{
	$return = [];
	$hasStart = false;
	$nowOnIndex = 0;
	$arrayCount = count($carpark);
	foreach ($carpark as $index => $row) {
		if (!$hasStart) {
			if (in_array(2, $row, true)) {
				$nowOnIndex = array_search(2, $row, true);
				[$move, $nowOnIndex] = countSteps($row, $nowOnIndex);
				if ($move != null) {
					$return[] = $move;
				}
				if ($arrayCount != $index + 1) {
					$return[] = 'D1';
				}
				$hasStart = true;
			}
		}else {
			[$move, $nowOnIndex] = countSteps($row, $nowOnIndex);
			if ($move != null) {
				$return[] = $move;
				if ($arrayCount != $index + 1) {
					$return[] = 'D1';
				}
			}else {
				if ($arrayCount != $index + 1) {
					$return[array_key_last($return)] = "D" . (str_split($return[array_key_last($return)])[1] + 1);
				}
			}

		}
	}
	return $return;
}

function countSteps(array $row, int $nowIndex): array
{
	if (in_array(1, $row, true)) {
		$goToIndex = array_search(1, $row, true);
	}else {
		$goToIndex = array_key_last($row);
	}

	if ($nowIndex > $goToIndex) {
		return ["L" . ($nowIndex - $goToIndex), $goToIndex];
	}elseif ($nowIndex < $goToIndex) {
		return ["R" . ($goToIndex - $nowIndex), $goToIndex];
	}else {
		return [null, $goToIndex];
	}
}
