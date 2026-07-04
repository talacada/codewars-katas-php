<?php

declare(strict_types=1);

/*
Write a method that takes a field for well-known board game "Battleship" as an argument and returns true if it has a valid disposition of ships, false otherwise. Argument is guaranteed to be 10*10 two-dimension array. Elements in the array are numbers, 0 if the cell is free and 1 if occupied by ship.

Battleship (also Battleships or Sea Battle) is a guessing game for two players. Each player has a 10x10 grid containing several "ships" and objective is to destroy enemy's forces by targetting individual cells on his field. The ship occupies one or more cells in the grid. Size and number of ships may differ from version to version. In this kata we will use Soviet/Russian version of the game.


Before the game begins, players set up the board and place the ships accordingly to the following rules:
There must be single battleship (size of 4 cells), 2 cruisers (size 3), 3 destroyers (size 2) and 4 submarines (size 1). Any additional ships are not allowed, as well as missing ships.
Each ship must be a straight line, except for submarines, which are just single cell.

The ship cannot overlap or be in contact with any other ship, neither by edge nor by corner.

This is all you need to solve this kata. If you're interested in more information about the game, visit this link.

https://www.codewars.com/kata/52bb6539a4cf1b12d90005b7
*/

namespace Kata\Y2026\Q2;

class BattleshipFieldValidator
{
    private array $field;
    private array $fieldWithoutFoundShips;
    public const SHIPS = [
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

    public const POSSIBLE_DIRECTIONS_OF_SHIP = [
        [0, -1],
        [-1, 0],
        [1, 0],
        [0, 1]
    ];

    public function __construct(array $field)
    {
        $this->field = $field;
        $this->fieldWithoutFoundShips = $field;
    }

    public function isFieldValid(): bool
    {
        return $this->searchForShips();
    }

    private function searchForShips(): bool
    {
        return
            $this->validateSpecificTypeOfShip(self::SHIPS['battleship']) &&
            $this->validateSpecificTypeOfShip(self::SHIPS['cruiser']) &&
            $this->validateSpecificTypeOfShip(self::SHIPS['destroyer']) &&
            $this->validateSpecificTypeOfShip(self::SHIPS['submarine']) &&
            !$this->hasExtraShips();

    }

    private function validateSpecificTypeOfShip(array $shipInfo): bool
    {
        for ($i = 0; $i < $shipInfo['count']; $i++) {
            $ship = $this->findShipBySize($shipInfo['size']);
            if ($ship === []) {
                return false;
            }
            if ($this->validateFreeSpaceAroundShip($ship) === false) {
                return false;
            }
        }
        return true;
    }

    private function findShipBySize(int $size): array
    {
        foreach ($this->fieldWithoutFoundShips as $rowIndex => $row) {
            foreach ($row as $columnIndex => $cell) {
                if ($cell === 1) {
                    foreach (self::POSSIBLE_DIRECTIONS_OF_SHIP as $direction) {
                        $possibleShip = [[$rowIndex, $columnIndex]];
                        $multiplier = $direction[0] + $direction[1] > 0 ? 1 : -1;
                        if ($size === 1) {
                            foreach ($possibleShip as $returnCell) {
                                $this->fieldWithoutFoundShips[$returnCell[0]][$returnCell[1]] = 0;
                            }
                            return $possibleShip;
                        }
                        for ($i = 0; $i < $size - 1; $i++) {
                            $x = $rowIndex + $direction[0] + ($direction[0] === 0 ? 0 : $i * $multiplier);
                            $y = $columnIndex + $direction[1] + ($direction[1] === 0 ? 0 : $i * $multiplier);
                            if (isset($this->fieldWithoutFoundShips[$x][$y]) && $this->fieldWithoutFoundShips[$x][$y] === 1) {
                                $possibleShip[] = [$x, $y];
                            } else {
                                break;
                            }

                            if (count($possibleShip) === $size) {
                                //deleting ship so next discovery algorithm will not see this
                                foreach ($possibleShip as $returnCell) {
                                    $this->fieldWithoutFoundShips[$returnCell[0]][$returnCell[1]] = 0;
                                }
                                return $possibleShip;
                            }
                        }
                    }
                }
            }
        }
        return [];
    }

    private function validateFreeSpaceAroundShip(array $ship): bool
    {
        foreach ($ship as $cell) {
            for ($x = -1; $x < 2; $x++) {
                for ($y = -1; $y < 2; $y++) {

                    if (isset($this->field[$cell[0] + $x][$cell[1] + $y])) {
                        if (!in_array([$cell[0] + $x, $cell[1] + $y], $ship, true) && $this->field[$cell[0] + $x][$cell[1] + $y] === 1) {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    private function hasExtraShips(): bool
    {
        $oneArray = array_merge(...$this->fieldWithoutFoundShips);

        return in_array(1, $oneArray, true);
    }
}
