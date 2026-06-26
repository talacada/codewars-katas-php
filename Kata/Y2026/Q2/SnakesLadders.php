<?php

declare(strict_types=1);

/*
Introduction
Snakes and Ladders is an ancient Indian board game regarded today as a worldwide classic. It is played by two or
more players on a game board with numbered, gridded squares. A number of "ladders" and "snakes" are pictured on
the board, each connecting two specific squares. (Source: Wikipedia)

Task
Your task is to create a simple class called SnakesLadders. The test cases will call the method play(die1, die2)
independently of the state of the game or the player turn. The arguments die1 and die2 are the dice thrown in a
turn and are both integers between 1 and 6. The player will make a number of steps equal to the sum of die1 and die2,
moving one square per step.

Rules
There are two players, and both start off the board on square 0.
Player 1 starts and alternates with player 2.
You follow the numbers up the board in order from 1 to 100.
If the values of both dice are the same, that player will have another turn after the current turn ends.
Climb up ladders. The ladders on the game board allow you to move upwards and get ahead faster. If you land exactly on a square that shows the bottom of a ladder, you may move the player all the way up to the square at the top of the ladder (even if you roll a double).
Slide down snakes. Snakes move you back on the board. If you land exactly on the top of a snake, you must slide all the way down to the square at the bottom of the snake or chute (even if you roll a double).
Land exactly on the last square to win. The first player to reach the highest square on the board wins. If you roll too high, your player "bounces" off square 100 and continues moving backward for the remaining steps. You can only win by rolling the exact number needed to land on the last square. For example, if you are on square 98 and roll a five, move your piece to 100 (two steps), then "bounce" back to 99, 98, and 97 (three, four, then five steps).
If the player rolls a double and lands on the finish square (100) after taking all steps for the roll, the player wins the game and does not take another turn.
Returns
Return "Player n Wins!" where n is the winning player who has landed on square 100 after taking all steps in their turn.

Return "Game over!" if a move is attempted after any player has won.

Otherwise, return "Player n is on square x", where n is the current player and x is the square they are currently on.

Good luck and enjoy!

https://www.codewars.com/kata/587136ba2eefcb92a9000027
*/

namespace Kata\Y2026\Q2;

class SnakesLadders
{
    public const SNAKES =
        [
            16 => 6,
            46 => 25,
            49 => 11,
            62 => 19,
            64 => 60,
            74 => 53,
            89 => 68,
            92 => 88,
            95 => 75,
            99 => 80
        ];
    public const LADDERS = [
        2 => 38,
        7 => 14,
        8 => 31,
        15 => 26,
        21 => 42,
        28 => 84,
        36 => 44,
        51 => 67,
        71 => 91,
        78 => 98,
        87 => 94,
    ];

    private array $position = [1 => 0, 2 => 0];
    private int $onTurn = 1;
    private bool $gameOver = false;
    public function __construct()
    {
    }

    public function play(int $die1, int $die2): string
    {
        if ($this->gameOver) {
            return "Game over!";
        }

        $sum = $die1 + $die2;

        if (array_key_exists($this->position[$this->onTurn] + $sum, SnakesLadders::LADDERS)) {
            $this->position[$this->onTurn] = SnakesLadders::LADDERS[$this->position[$this->onTurn] + $sum];
        } elseif (array_key_exists($this->position[$this->onTurn] + $sum, SnakesLadders::SNAKES)) {
            $this->position[$this->onTurn] = SnakesLadders::SNAKES[$this->position[$this->onTurn] + $sum];
        } else {
            if ($this->position[$this->onTurn] + $sum > 100) {
                $this->position[$this->onTurn] = 100 - ($this->position[$this->onTurn] + $sum - 100);
                if (array_key_exists($this->position[$this->onTurn], SnakesLadders::LADDERS)) {
                    $this->position[$this->onTurn] = SnakesLadders::LADDERS[$this->position[$this->onTurn]];
                } elseif (array_key_exists($this->position[$this->onTurn], SnakesLadders::SNAKES)) {
                    $this->position[$this->onTurn] = SnakesLadders::SNAKES[$this->position[$this->onTurn]];
                }
            } else {
                $this->position[$this->onTurn] += $sum;
            }
        }

        if ($this->position[$this->onTurn] === 100) {
            $this->gameOver = true;
            return "Player " . $this->onTurn . " Wins!";
        }

        $return = "Player " . $this->onTurn . " is on square " . $this->position[$this->onTurn];

        if ($die1 != $die2) {
            if ($this->onTurn === 1) {
                $this->onTurn = 2;
            } else {
                $this->onTurn = 1;
            }
        }

        return $return;
    }
}
