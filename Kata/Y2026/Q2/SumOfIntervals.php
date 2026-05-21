<?php

/*
Write a function called sumIntervals/sum_intervals that accepts an array of intervals, and returns the sum of all the interval lengths. Overlapping intervals should only be counted once.

Intervals
Intervals are represented by a pair of integers in the form of an array. The first value of the interval will always be less than the second value. Interval example: [1, 5] is an interval from 1 to 5. The length of this interval is 4.

Overlapping Intervals
List containing overlapping intervals:

[
   [1, 4],
   [7, 10],
   [3, 5]
]
The sum of the lengths of these intervals is 7. Since [1, 4] and [3, 5] overlap, we can treat the interval as [1, 5], which has a length of 4.

Examples:
sumIntervals( [
   [1, 2],
   [6, 10],
   [11, 15]
] ) => 9

sumIntervals( [
   [1, 4],
   [7, 10],
   [3, 5]
] ) => 7

sumIntervals( [
   [1, 5],
   [10, 20],
   [1, 6],
   [16, 19],
   [5, 11]
] ) => 19

sumIntervals( [
   [0, 20],
   [-100000000, 10],
   [30, 40]
] ) => 100000030
Tests with large intervals
Your algorithm should be able to handle large intervals. All tested intervals are subsets of the range [-1000000000, 1000000000].

https://www.codewars.com/kata/52b7ed099cdc285c300001cd/train/php
*/

namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function sum_intervals(array $intervals): int {
	$sum = 0;
	$counted = [];
	foreach ($intervals as $interval) {
		foreach ($counted as $countedIndex => $singleCount) {
			//Bigger interval ate whole smaller interval
			if ($interval[0] >= $singleCount[0] && $interval[1] <= $singleCount[1]) {
				$interval = [];
				break;
			//Only the end of interval was eaten
			}elseif ($interval[0] <= $singleCount[0] && ($interval[1] >= $singleCount[0] && $interval[1] <= $singleCount[1])) {
				$interval = [$interval[0], $singleCount[0]];
			//Only the start of interval was eaten
			}elseif (($interval[0] >= $singleCount[0] && $interval[0] <= $singleCount[1]) && $interval[1] >= $singleCount[1]) {
				$interval = [$singleCount[1], $interval[1]];
			//Only a portion in middle was ean by smaller interval
			}elseif ($interval[0] <= $singleCount[0] && $interval[1] >= $singleCount[1]) {
				unset($counted[$countedIndex]);
			}
		}
		if ($interval !== []) {
			$counted[] = $interval;
		}
	}

	foreach ($counted as $singleInterval) {
		$sum += $singleInterval[1] - $singleInterval[0];
	}

	return $sum;
}

class SumOfIntervals extends TestCase {
	public function testExamples() {
		// Non-overlapping intervals
		$this->assertSame(4, sum_intervals([[1, 5]]));
		$this->assertSame(8, sum_intervals([
			[1, 5],
			[6, 10]
		]));
		// Overlapping intervals
		$this->assertSame(4, sum_intervals([
			[1, 5],
			[1, 5]
		]));
		$this->assertSame(7, sum_intervals([
			[1, 4],
			[7, 10],
			[3, 5]
		]));
	}

	public function testLargeIntervals() {
		$this->assertSame((int)2e9, sum_intervals([[(int)-1e9, (int)1e9]]));
		$this->assertSame((int)1e8 + 30, sum_intervals([
			[0, 20],
			[(int)-1e8, 10],
			[30, 40]
		]));
	}

	public function testMultipleSameStart() {
		// Všechny intervaly začínají na 2, nejdelší končí na 9 => [2,9] => 7
		$this->assertSame(7, sum_intervals([
			[2, 3],
			[2, 6],
			[2, 4],
			[2, 9],
			[2, 5],
		]));
	}

	public function testNestedIntervals() {
		// [1,10] překryje vše => délka 9
		$this->assertSame(9, sum_intervals([
			[1, 10],
			[2, 5],
			[3, 4],
		]));
	}

	public function testTouchingIntervals() {
		// Dotýkající se, ale nepřekrývající se: [1,5] + [5,10] = 4 + 5 = 9
		$this->assertSame(9, sum_intervals([
			[1, 5],
			[5, 10],
		]));
	}

	public function testMixedOverlapping() {
		// Složitější mix z Codewars testů
		$this->assertSame(157, sum_intervals([
			[227, 238],
			[-39, -22],
			[230, 240],
			[303, 320],
			[-310, -302],
			[90, 96],
			[28, 37],
			[-251, -236],
			[-70, -57],
			[28, 38],
			[73, 79],
			[232, 235],
			[296, 307],
			[-187, -174],
			[54, 68],
			[387, 402],
			[393, 405],
		]));
	}

	public function testManyIntervals() {
		// 100 intervalů s velkými čísly (stejná struktura jako Codewars test)
		$intervals = [
			[-815625711, -809874089],
			[-628657516, -626884052],
			[-792244848, -784831540],
			[835139310, 843447684],
			[61588117, 64397170],
			[-269350613, -261504211],
			[-717008749, -707098200],
			[509359031, 515867903],
			[-285891809, -282654545],
			[-629421369, -620973891],
			[524524658, 534092253],
			[-533054392, -524831371],
			[905742817, 914114104],
			[-891717616, -883619643],
			[562781385, 567585059],
			[88004247, 92706111],
			[-999999999, -990000000],
			[990000000, 999999999],
			[-500000000, -400000000],
			[400000000, 500000000],
			[-100000000, 100000000],
			[-50, 50],
			[-10, 10],
			[0, 100],
			[50, 150],
			[200, 300],
			[250, 350],
			[400, 500],
			[450, 550],
			[600, 700],
			[650, 750],
			[800, 900],
			[850, 950],
			[1000, 1100],
			[1050, 1150],
			[-500, -400],
			[-450, -350],
			[-300, -200],
			[-250, -150],
			[-100, 0],
			[-50, 50],
			[0, 0],
			[1, 1],
			[5, 10],
			[10, 15],
			[15, 20],
			[20, 25],
			[25, 30],
			[30, 35],
			[1, 100],
			[2, 3],
			[4, 5],
			[6, 7],
			[8, 9],
			[10, 11],
			[12, 13],
			[14, 15],
			[16, 17],
			[18, 19],
			[20, 21],
			[-1000000000, 1000000000],
			[-500, 500],
			[-100, -50],
			[-75, -25],
			[-60, -40],
			[25, 75],
			[50, 100],
			[75, 125],
			[200, 250],
			[225, 275],
			[240, 260],
			[300, 400],
			[350, 450],
			[375, 425],
			[500, 600],
			[550, 650],
			[575, 625],
			[700, 800],
			[750, 850],
			[775, 825],
			[900, 1000],
			[950, 1050],
			[975, 1025],
			[-900, -800],
			[-850, -750],
			[-825, -775],
			[-700, -600],
			[-650, -550],
			[-625, -575],
			[-500, -400],
			[-450, -350],
			[-425, -375],
			[-300, -200],
			[-250, -150],
			[-225, -175],
			[-100, 0],
			[-50, 50],
			[-25, 25],
			[0, 0],
		];
		// Očekávaná hodnota: interval [-1000000000, 1000000000] pokryje vše => 2000000000
		$this->assertSame(2000000000, sum_intervals($intervals));
	}
}
