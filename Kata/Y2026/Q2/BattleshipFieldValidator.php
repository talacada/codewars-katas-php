<?php
/*
Write a method that takes a field for well-known board game "Battleship" as an argument and returns true if it has a valid disposition of ships, false otherwise. Argument is guaranteed to be 10*10 two-dimension array. Elements in the array are numbers, 0 if the cell is free and 1 if occupied by ship.

Battleship (also Battleships or Sea Battle) is a guessing game for two players. Each player has a 10x10 grid containing several "ships" and objective is to destroy enemy's forces by targetting individual cells on his field. The ship occupies one or more cells in the grid. Size and number of ships may differ from version to version. In this kata we will use Soviet/Russian version of the game.


Before the game begins, players set up the board and place the ships accordingly to the following rules:
There must be single battleship (size of 4 cells), 2 cruisers (size 3), 3 destroyers (size 2) and 4 submarines (size 1). Any additional ships are not allowed, as well as missing ships.
Each ship must be a straight line, except for submarines, which are just single cell.

The ship cannot overlap or be in contact with any other ship, neither by edge nor by corner.

This is all you need to solve this kata. If you're interested in more information about the game, visit this link.

*/

namespace Kata\Y2026\Q2;

class BattleshipFieldValidator {
	private array $field = [];
	const USED_SPACE = 20;
	const SHIPS = [
		'battleship' => [
			'count' => 1,
			'size' => 4
		],
		'cruiser' => [
			'count' => 2,
			'size' => 3
		],
		'destroyer' => [
			'count' => 3,
			'size' => 2
		],
		'submarine' => [
			'count' => 4,
			'size' => 1
		]
	];

	const POSSIBLE_DIRECTIONS_OF_SHIP = [
		[0, -1],
		[-1, 0],
		[1, 0],
		[0, 1]
	];

	public function __construct($field) {
		$this->field = $field;
	}

	public function isFieldValid(): bool
	{
		return $this->searchForShips();
	}

	private function searchForShips(): bool
	{
		if (
			$this->validateSpecificTypeOfShip(self::SHIPS['battleship']) &&
			$this->validateSpecificTypeOfShip(self::SHIPS['cruiser']) &&
			$this->validateSpecificTypeOfShip(self::SHIPS['destroyer']) &&
			$this->validateSpecificTypeOfShip(self::SHIPS['submarine'])
		) {
			return false;
		} else {
			return true;
		}
	}

	private function validateSpecificTypeOfShip(array $shipInfo): bool
	{
		$tempGrid = $this->field;
		for ($i = 0; $i < $shipInfo['count']; $i++) {
			[$ship, $tempGrid] = $this->findShipBySize($shipInfo['size'], $tempGrid);
			if ($ship === []) {
				return false;
			}
			if ($this->validateFreeSpaceAroundShip($ship) === false) {
				return false;
			};
		}
		return true;
	}

	private function findShipBySize(int $size, array $grid): array
	{
		//TODO najít a vrátit pozici všech políček lodi v arrayi
		foreach ($grid as $rowIndex => $row) {
			foreach ($row as $columnIndex => $cell) {
				$possibleShip = [];
				if ($cell === 1) {
					$possibleShip[] = [$rowIndex, $columnIndex];
					foreach (self::POSSIBLE_DIRECTIONS_OF_SHIP as $direction) {
						$nowX = $rowIndex;
						$nowY = $rowIndex;
						$multiplier = $direction[0] + $direction[1] > 0 ? 1 : -1;
						for ($i = 0; $i < $size; $i++) {
							$x = $nowX + $direction[0] + $direction[0] === 0 ? 0 : $i*$multiplier;
							$y = $nowY + $direction[1] + $direction[1] === 0 ? 0 : $i*$multiplier;
							if (isset($grid[$x][$y]) && $grid[$x][$y] === 1) {
								$possibleShip[] = [$rowIndex, $columnIndex];
								$nowX = $x;
								$nowY = $y;
							}else {
								break;
							}

							if ($i === $size - 1) {
								return [$possibleShip];
							}
						}
					}
				}
			}
		}

	}

	private function validateFreeSpaceAroundShip(array $ship): bool
	{
		//TODO dostanu vsechna policka (indexy) kde je loď ověřím všechna políška okolo jestli je prázdno, lodě nemohou být hned vedle sebe...
	}

	private function discoverShip(array $startindex, array $field): array
	{

	}
}