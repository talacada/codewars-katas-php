<?php

/*

RoboScript #2 - Implement the RS1 Specification
Disclaimer
The story presented in this Kata Series is purely fictional; any resemblance to actual programming languages, products, organisations or people should be treated as purely coincidental.

About this Kata Series
This Kata Series is based on a fictional story about a computer scientist and engineer who owns a firm that sells a toy robot called MyRobot which can interpret its own (esoteric) programming language called RoboScript. Naturally, this Kata Series deals with the software side of things (I'm afraid Codewars cannot test your ability to build a physical robot!).

Story
Now that you've built your own code editor for RoboScript with appropriate syntax highlighting to make it look like serious code, it's time to properly implement RoboScript so that our MyRobots can execute any RoboScript provided and move according to the will of our customers. Since this is the first version of RoboScript, let's call our specification RS1 (like how the newest specification for JavaScript is called ES6 :p)

Task
Write an interpreter for RS1 called execute() which accepts 1 required argument code, the RS1 program to be executed. The interpreter should return a string representation of the smallest 2D grid containing the full path that the MyRobot has walked on (explained in more detail later).

Initially, the robot starts at the middle of a 1x1 grid. Everywhere the robot walks it will leave a path "*". If the robot has not been at a particular point on the grid then that point will be represented by a whitespace character " ". So if the RS1 program passed in to execute() is empty, then:

""  -->  "*"
The robot understands 3 major commands:

F - Move forward by 1 step in the direction that it is currently pointing. Initially, the robot faces to the right.
L - Turn "left" (i.e. rotate 90 degrees anticlockwise)
R - Turn "right" (i.e. rotate 90 degrees clockwise)
As the robot moves forward, if there is not enough space in the grid, the grid should expand accordingly. So:

"FFFFF"  -->  "******"
As you will notice, 5 F commands in a row should cause your interpreter to return a string containing 6 "*"s in a row. This is because initially, your robot is standing at the middle of the 1x1 grid facing right. It leaves a mark on the spot it is standing on, hence the first "*". Upon the first command, the robot moves 1 unit to the right. Since the 1x1 grid is not large enough, your interpreter should expand the grid 1 unit to the right. The robot then leaves a mark on its newly arrived destination hence the second "*". As this process is repeated 4 more times, the grid expands 4 more units to the right and the robot keeps leaving a mark on its newly arrived destination so by the time the entire program is executed, 6 "squares" have been marked "*" from left to right.

Each row in your grid must be separated from the next by a CRLF (\r\n). Let's look at another example:

"FFFFFLFFFFFLFFFFFLFFFFFL"  -->  "******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******"
So the grid will look like this:

******
*    *
*    *
*    *
*    *
******
The robot moves 5 units to the right, then turns left, then moves 5 units upwards, then turns left again, then moves 5 units to the left, then turns left again and moves 5 units downwards, returning to the starting point before turning left one final time. Note that the marks do not disappear no matter how many times the robot steps on them, e.g. the starting point is still marked "*" despite the robot having stepped on it twice (initially and on the last step).

Another example:

"LFFFFFRFFFRFFFRFFFFFFF"  -->  "    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   "
So the grid will look like this:

    ****
    *  *
    *  *
********
    *
    *
Initially the robot turns left to face upwards, then moves upwards 5 squares, then turns right and moves 3 squares, then turns right again (to face downwards) and move 3 squares, then finally turns right again and moves 7 squares.

Since you've realised that it is probably quite inefficient to repeat certain commands over and over again by repeating the characters (especially the F command - what if you want to move forwards 20 steps?), you decide to allow a shorthand notation in the RS1 specification which allows your customers to postfix a non-negative integer onto a command to specify how many times an instruction is to be executed:

Fn - Execute the F command n times (NOTE: n may be more than 1 digit long!)
Ln - Execute L n times
Rn - Execute R n times
So the example directly above can also be written as:

"LF5RF3RF3RF7"
These 5 example test cases have been included for you :)

https://www.codewars.com/kata/5870fa11aa0428da750000da
*/

namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function execute(string $code): string {
	$codeString = $code;
	$digits = '0123456789';
	$code = str_split($code);
	$facing = 1;
	$grid = [['*']];
	$position = [0, 0];

	foreach ($code as $index => $step) {
		$times = 1;
		if (is_numeric($step)) {
			continue;
		}
		if (isset($code[$index + 1]) && is_numeric($code[$index + 1])) {
			$nextNumbers = strspn($codeString, $digits, $index +1);
			$times = (int) substr($codeString, $index + 1, $nextNumbers);
		}

		if ($step === 'F') {
			[$grid, $position] = move($grid, $facing, $times, $position);
		}elseif ($step === 'L' || $step === 'R') {
			$facing = turn($step, $facing, $times);
		}
	}

	$returnString = "";
	foreach ($grid as $index => $row) {
		$returnString .= implode('', $row);
		if ($index < count($grid) - 1) {
			$returnString .= "\r\n";
		}
	}

	return $returnString;
}

function turn(string $rotationSide, int $facing, int $times): int
{
	if ($rotationSide === 'R') {
		$facing = ($facing + $times) % 4;
	}elseif ($rotationSide === 'L') {
		$facing = ($facing - $times) % 4;
		if ($facing < 0) {
			$facing = abs($facing);
			if ($facing === 1) {
				$facing = 3;
			}elseif ($facing === 3) {
				$facing = 1;
			}
		}
	}
	return $facing;
}

function move(array $grid, int $facing, int $times, array $position): array
{
	$moveMap = [
		0 => [-1, 0],
		1 => [0, 1],
		2 => [1, 0],
		3 => [0, -1],
	];
	for ($i = 0; $i < $times; $i++) {
		if (!isset($grid[$position[0] + $moveMap[$facing][0]][$position[1] + $moveMap[$facing][1]])) {
			[$grid, $position] = extendGrid($grid, $facing, $position);
		}
		$grid[$position[0] + $moveMap[$facing][0]][$position[1] + $moveMap[$facing][1]] = '*';
		$position = [$position[0] + $moveMap[$facing][0], $position[1] + $moveMap[$facing][1]];
	}

	return [$grid, $position];
}

function extendGrid(array $grid, int $facing, $position): array
{
	if ($facing === 0 || $facing === 2) {
		$empty = array_fill(0, count($grid[0]), ' ');
		if ($facing === 0) {
			array_unshift($grid, $empty);
			$position[0] += 1;
		}else {
			$grid[] = $empty;
		}
	}elseif ($facing === 1 || $facing === 3) {
		foreach ($grid as $index => $row) {
			if ($facing === 1) {
				$row[] = ' ';
			}else {
				array_unshift($row, ' ');
			}
			$grid[$index] = $row;
		}
		if ($facing === 3) {
			$position[1] += 1;
		}
	}
	return [array_values($grid), $position];
}


class RoboScript2 extends TestCase {
	public function testDescriptionExamples() {
		$this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", execute("FFFFFLFFFFFLFFFFFLFFFFFL"));
		$this->assertSame("*", execute(""));
		$this->assertSame("******", execute("FFFFF"));
		$this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", execute("FFFFFLFFFFFLFFFFFLFFFFFL"));
		$this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", execute("LFFFFFRFFFRFFFRFFFFFFF"));
		$this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", execute("LF5RF3RF3RF7"));
	}

	public function testSimpleDebug() {
		$this->assertSame("***\r\n*  \r\n*  ", execute("LF2RF2"));
	}

	public function testMultiDigitParsing() {
		$this->assertSame("*************", execute("F12"));
	}

	public function testLeftTurnFromDown() {
		$this->assertSame("* \r\n**", execute("RFLF"));
	}
}