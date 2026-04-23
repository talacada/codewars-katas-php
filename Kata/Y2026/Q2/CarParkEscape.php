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

*/


namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function escape($carpark): array
{
	$return = [];
	//
	return $return;
}


class CarParkEscape extends TestCase
{
	public function testSampleTests()
	{
		$carpark = [[1, 0, 0, 0, 2],
			[0, 0, 0, 0, 0]];
		$result = ["L4", "D1", "R4"];

		$this->assertSame($result, escape($carpark));

		$carpark = [[2, 0, 0, 1, 0],
			[0, 0, 0, 1, 0],
			[0, 0, 0, 0, 0]];
		$result = ["R3", "D2", "R1"];

		$this->assertSame($result, escape($carpark));

		$carpark = [[0, 2, 0, 0, 1],
			[0, 0, 0, 0, 1],
			[0, 0, 0, 0, 1],
			[0, 0, 0, 0, 0]];
		$result = ["R3", "D3"];

		$this->assertSame($result, escape($carpark));

		$carpark = [[1, 0, 0, 0, 2],
			[0, 0, 0, 0, 1],
			[1, 0, 0, 0, 0],
			[0, 0, 0, 0, 0]];
		$result = ["L4", "D1", "R4", "D1", "L4", "D1", "R4"];

		$this->assertSame($result, escape($carpark));
	}
}