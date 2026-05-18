<?php
/* DATE: 14.04.Y2026
Given a 2D array and a number of generations, compute n timesteps of Conway's Game of Life.

The rules of the game are:

Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
Any live cell with more than three live neighbours dies, as if by overcrowding.
Any live cell with two or three live neighbours lives on to the next generation.
Any dead cell with exactly three live neighbours becomes a live cell.
Each cell's neighborhood is the 8 cells immediately around it (i.e. Moore Neighborhood). The universe is infinite in both the x and y dimensions and all cells are initially dead - except for those specified in the arguments. The return value should be a 2d array cropped around all of the living cells. (If there are no living cells, then return [[]].)

For illustration purposes, 0 and 1 will be represented as ░░ and ▓▓ blocks respectively (PHP: plain black and white squares). You can take advantage of the htmlize function to get a text representation of the universe, e.g.:

echo htmlize($cells) . "\r\n";

https://www.codewars.com/kata/52423db9add6f6fc39000354
*/
namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function get_generation(array $cells, int $generations): array
{
	for ($currentGen = 0; $currentGen < $generations; $currentGen++) {
		$cells = addEmptyAround($cells);
		$lastIterationCells = $cells;
		for ($row = 0; $row < count($lastIterationCells); $row++) {
			for ($column = 0; $column < count($lastIterationCells[0]); $column++) {
				$liveNeighbours = getLiveNeighbours($lastIterationCells, $row, $column);
				if ($lastIterationCells[$row][$column] === 1) {
					if ($liveNeighbours === 2 || $liveNeighbours === 3) {
						$cells[$row][$column] = 1;
					} else {
						$cells[$row][$column] = 0;
					}
				} else {
					if ($liveNeighbours === 3) {
						$cells[$row][$column] = 1;
					} else {
						$cells[$row][$column] = 0;
					}
				}
			}
		}
		$cells = removeEmptyAround($cells);
	}
	return checkIfAllDead($cells);
}

function getLiveNeighbours(array $cells, int $row, int $column): int
{
	$count = 0;
	for ($r = -1; $r <= 1; $r++) {
		for ($c = -1; $c <= 1; $c++) {

			if ($r === 0 && $c === 0) {
				continue;
			}

			if (isset($cells[$row + $r][$column + $c]) && $cells[$row + $r][$column + $c] === 1) {
				$count++;
			}
		}
	}
	return $count;
}

function addEmptyAround(array $cellsStart):array {
	$newCells = [];
	array_push($newCells, extendRow([], count($cellsStart[0]) + 2));
	foreach ($cellsStart as $row) {
		array_push($newCells, extendRow($row));
	}
	array_push($newCells, extendRow([], count($cellsStart[0]) + 2));
	return $newCells;
}

function extendRow(array $row, int $rowLenght = 0):array {
	$newRow = [];
	if ($rowLenght != 0) {
		for ($i = 0; $i < $rowLenght; $i++) {
			array_push($newRow, 0);
		}
		return $newRow;
	}

	array_unshift($row, 0);
	array_push($row, 0);

	return $row;
}

function removeEmptyAround(array $cells):array {
	$cellsNew = [];
	$cellsFinal = [];
	$keys =  [0, array_key_last($cells)];
	$cellsNew = $cells;
	foreach ($keys as $index => $key) {
		for($realRow = 0; $realRow < count($cellsNew); $realRow++) {
			if ($index === 0) {
				if (count(array_unique($cells[$realRow + $key])) === 1) {
					unset($cellsNew[$realRow + $key]);
				}else {
					break;
				}
			}elseif ($index === 1) {
				if (count(array_unique($cells[$key - $realRow])) === 1) {
					unset($cellsNew[$key - $realRow]);
				}else {
					break;
				}
			}
		}
	}
	$cellsNew = array_values($cellsNew);
	$keys =  [0, array_key_last($cellsNew[0])];
	$cellsFinal = $cellsNew;
	foreach ($keys as $index => $key) {
		$findOne = false;
		while ($findOne === false) {
			$allZero = true;
			for($realCol = 0; $realCol < count($cellsNew[0]); $realCol++) {
				for($r = 0; $r < count($cellsNew); $r++) {
					if ($index === 0) {
						if ($cellsNew[$r][$key + $realCol] === 1) {
							$allZero = false;
							$findOne = true;
							break;
						}
					}elseif ($index === 1) {
						if ($cellsNew[$r][$key - $realCol] === 1) {
							$allZero = false;
							$findOne = true;
							break;
						}
					}
				}
				if ($allZero === true) {
					if ($index === 0) {
						for($r = 0; $r < count($cellsNew); $r++) {
							unset($cellsFinal[$r][$key + $realCol]);
						}
					}elseif ($index === 1) {
						for($r = 0; $r < count($cellsNew); $r++) {
							unset($cellsFinal[$r][$key - $realCol]);
						}
					}
				}
			}
			if ($findOne === false) {
				break;
			}
		}
	}
	foreach ($cellsFinal as $key => $row) {
		$cellsFinal[$key] = array_values($row);
	}
	return $cellsFinal;
}

function checkIfAllDead(array $cells):array {
	foreach($cells as $row) {
		if (in_array(1, $row) === true) {
			return $cells;
		}
	}
	return [[]];
}

class ConwaysGameOfLifeUnlimitedEdition extends TestCase
{
	public function testExample()
	{
		$this->assertSame([
			[0, 1, 0],
			[0, 0, 1],
			[1, 1, 1]
		], get_generation([
			[1, 0, 0],
			[0, 1, 1],
			[1, 1, 0]
		], 1));
	}

	public function test2()
	{
		$this->assertSame([
			[1, 0, 1],
			[0, 1, 1],
			[0, 1, 0]
		], get_generation([
			[1, 0, 0],
			[0, 1, 1],
			[1, 1, 0]
		], 2));
	}

	public function testEmpty(){
		$this->assertSame([
			[]
		], get_generation([
			[0, 0, 0],
			[0, 0, 0],
			[0, 0, 0]
		], 1));
	}
}