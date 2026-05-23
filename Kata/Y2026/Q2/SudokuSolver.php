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

use PHPUnit\Framework\TestCase;

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
		1. Získat ke každému poli $row, $column, $square
		2. z 0 udělat array všech možných co na daném místě mohou být (0 -> [1, 5, 6, 9])
		3. Projíždět ten cyklus do nekonečka, jelikož autor říkal že nemusí být žádné tipování, takže v každém průběhu cyklu se něco určitě vyplní co umožní vyplnit další
		*/

		$changed = true;
		while ($changed) {
			foreach ($this->grid as $rowIndex => $row) {
				foreach ($row as $columnIndex => $cell) {
					if ($cell != 0) {
						continue;
					}
					[$column, $square] = $this->getColumnAndSquare($rowIndex, $columnIndex);
				}
			}
		}

		return $this->grid;
	}

	private function getColumnAndSquare(int $rowIndex, int $columnIndex): array
	{
		$column = [];
		for ($row = 0; $row < 8; $row++) {
			$column[] = $this->grid[$row][$columnIndex];
		}

		//TODO return square
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
}