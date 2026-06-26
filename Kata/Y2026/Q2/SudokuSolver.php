<?php

/*
Write a function that will solve a 9x9 Sudoku puzzle. The function will take one argument consisting of the 2D puzzle array, with the value 0 representing an unknown square.

The Sudokus tested against your function will be "easy" (i.e. determinable; there will be no need to assume and test possibilities on unknowns) and can be solved with a brute-force approach.

For Sudoku rules, see the Wikipedia article.

sudoku([
  [5,3,0,0,7,0,0,0,0],
  [6,0,0,1,9,5,0,0,0],
  [0,9,8,0,0,0,0,6,0],
  [8,0,0,0,6,0,0,0,3],
  [4,0,0,8,0,3,0,0,1],
  [7,0,0,0,2,0,0,0,6],
  [0,6,0,0,0,0,2,8,0],
  [0,0,0,4,1,9,0,0,5],
  [0,0,0,0,8,0,0,7,9]
]); /* => [
  [5,3,4,6,7,8,9,1,2],
  [6,7,2,1,9,5,3,4,8],
  [1,9,8,3,4,2,5,6,7],
  [8,5,9,7,6,1,4,2,3],
  [4,2,6,8,5,3,7,9,1],
  [7,1,3,9,2,4,8,5,6],
  [9,6,1,5,3,7,2,8,4],
  [2,8,7,4,1,9,6,3,5],
  [3,4,5,2,8,6,1,7,9]
]

https://www.codewars.com/kata/5296bc77afba8baa690002d7
*/

namespace Kata\Y2026\Q2;

class SudokuSolver {

	private array $grid;

	public function __construct(array$grid)
	{
		$this->grid = $grid;
	}

	public function solve(): array
	{
		/*
		/plan
		1. Get $row, $column, $square for each cell
		2. Convert 0 into an array of all possible values for that position (0 -> [1, 5, 6, 9])
		3. Run the loop indefinitely — the author said no guessing is needed, so each pass will definitely fill in something that unlocks the next cell
		*/

		$changed = true;
		while ($changed) {
			$changed = false;
			for ($rowIndex = 0; $rowIndex < 9; $rowIndex++) {
				for ($columnIndex = 0; $columnIndex < 9; $columnIndex++) {
					$cell = $this->grid[$rowIndex][$columnIndex];
					if ($cell != 0 && !is_array($cell)) {
						continue;
					}
					[$column, $square] = $this->getColumnAndSquare($rowIndex, $columnIndex);

					$onlyPossibleValues = $this->getPossibleValues($this->grid[$rowIndex], $column, $square);

					if (count($onlyPossibleValues) === 1) {
						$this->grid[$rowIndex][$columnIndex] = array_values($onlyPossibleValues)[0];
						$changed = true;
					}elseif (count($onlyPossibleValues) === 0) {
						return [0];
					}
					else {
						$this->grid[$rowIndex][$columnIndex] = $onlyPossibleValues;
					}
				}
			}
		}

		return $this->grid;
	}

	private function getColumnAndSquare(int $rowIndex, int $columnIndex): array
	{
		$column = [];
		for ($row = 0; $row < 9; $row++) {
			$column[] = $this->grid[$row][$columnIndex];
		}

		$square = [];
		$squareRow = floor($rowIndex / 3);
		$squareColumn = floor($columnIndex / 3);
		for ($sqRow = 0; $sqRow < 3; $sqRow++) {
			for ($sqColumn = 0; $sqColumn < 3; $sqColumn++) {
				$square[] = $this->grid[$squareRow * 3 + $sqRow][$squareColumn * 3 + $sqColumn];
			}
		}

		return [$column, $square];
	}

	private function getPossibleValues(array $row, array $column, array $square): array
	{
		$allPossibleValues = [1, 2, 3, 4, 5, 6, 7, 8, 9];


		return array_diff(
			$allPossibleValues,
			array_filter($row, 'is_int'),
			array_filter($column, 'is_int'),
			array_filter($square, 'is_int')
		);
	}
}