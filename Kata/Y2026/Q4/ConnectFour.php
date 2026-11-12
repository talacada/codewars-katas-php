<?php

namespace Kata\Y2026\Q4\ConnectFour;

/*
Connect Four
Take a look at wiki description of Connect Four game:

Wiki Connect Four - https://en.wikipedia.org/wiki/Connect_Four

The grid is 6 row by 7 columns, those being named from A to G.

You will receive a list of strings showing the order of the pieces which dropped in columns:

  $piecesPositionList  = ["A_Red",
                          "B_Yellow",
                          "A_Red",
                          "B_Yellow",
                          "A_Red",
                          "B_Yellow",
                          "G_Red",
                          "B_Yellow"];
The list may contain up to 42 moves and shows the order the players are playing.

The first player who connects four items of the same color is the winner.

You should return "Yellow", "Red" or "Draw" accordingly.

https://www.codewars.com/kata/56882731514ec3ec3d000009

*/

/*
PLAN
- Classa Red a Yellow Implementují Token a Input - Což bude index sloupce a Token
- Deserializovat vstup na Input
- Naházet Input tokeny do 2D arraye
- Analyzovat jestli někdo má 4 v jednom z osmi směrů.
*/

function whoIsWinner($piecesPositionList): string
{
	$calculator = new ConnectFour($piecesPositionList);
	$calculator->dropTokensInField();
	$calculator->getWinner();
	return 's';
}
/*
Class for holding unified inputs and board
*/
class ConnectFour
{
	/*Constant mapping of letters to columns
	+ its defining number of possible columns*/
	const ROWTOINT = [
		"A" => 0,
		"B" => 1,
		"C" => 2,
		"D" => 3,
		"E" => 4,
		"F" => 5,
		"G" => 6,
		"H" => 7,
	];
	/** @var Input[] $input */
	private array $input;
	private Board $board;

	/* Construct function to deserialize string input into Input objects */
	public function __construct(array $inputRow){
		$inputs = [];
		$this->board = new Board;
		foreach ($inputRow as $singleInput) {
			$split = explode("_", $singleInput);
			$token = $split[1] === "Red" ? new Red() : new Yellow();

			$inputs[] = new Input($this::ROWTOINT[$split[0]], $token);
		}

		$this->input = $inputs;
	}

	/* Each input is dropped into board in sequence it was played */
	public function dropTokensInField():void
	{
		foreach ($this->input as $input) {
			$this->board->dropToken($input);
		}
	}

	/*  */
	public function getWinner():Yellow|Red|null
	{

		foreach ([new Yellow, new Red] as $color) {
			if ($this->board->isHorizontalWinner($color)) {
				return $color;
			}
			if ($this->board->isVerticalWinner($color)) {
				return $color;
			}

		}

		return null;
	}

}

/* class for holding user input as column where was token dropped and its color*/
class Input {
	private int $column;
	private Yellow|Red $token;

	public function __construct(int $column, Yellow|Red $token)
	{
		$this->column = $column;
		$this->token = $token;
	}

	public function getColumn(): int
	{
		return $this->column;
	}

	public function setColumn(int $column): void
	{
		$this->column = $column;
	}

	public function getToken(): Yellow|Red
	{
		return $this->token;
	}

	public function setToken(Yellow|Red $token): void
	{
		$this->token = $token;
	}


}

/* class indicating token color is red */
class Red
{

}

/* class indicating token color is yellow */
class Yellow
{

}

/* class representing playing board */
class Board {
	/* @var Row[] $rows */
	private array $rows = [];
	/* defining number of rows that will be generated */
	private const ROWCOUNT = 6;

	/* pregenerating empty rows into board*/
	public function __construct()
	{
		for ($i = 0; $i < self::ROWCOUNT; $i++) {
			$this->rows[] = new Row;
		}
	}

	/* Token is passed and placed into right row/column in board */
	public function dropToken(Input $token):void
	{
		$column = $token->getColumn();
		$row = 0;

		/* Cycle to determine witch row in column is first empty */
		foreach ($this->rows as $index => $row) {
			if ($row->getColumn($column) === null) {
				$row = $index;
				break;
			}
		}

		$this->rows[$row]->addToken($column, $token->getToken());
	}

	/* Function that accepts color and determine if color has winning combination in horizontal order (rows) */
	public function isHorizontalWinner(Red|Yellow $color):bool
	{
		foreach ($this->rows as $row) {
			$count = 0;
			foreach ($row->getTokens() as $token) {
				if ($token instanceof $color) {
					$count ++;
				}else {
					$count = 0;
				}

				if ($count === 4) {
					return true;
				}
			}
		}

		return false;
	}

	/*  */
	public function isVerticalWinner(Red|Yellow $color): bool
	{
		for ($i = 0; $i < count(ConnectFour::ROWTOINT); $i++) {
			$count = 0;
			for ($j = 0; $j < self::ROWCOUNT; $j++) {
				if ($this->rows[$j]->getTokenByIndex($i) instanceof $color) {
					$count ++;
				}else {
					$count = 0;
				}

				if ($count === 4) {
					return true;
				}
			}
		}

		return false;
	}
}

/* Class representing row on playing board */
class Row {

	/** @var Yellow|Red[] $tokens */
	private array $tokens = [];
	public function addToken(int $column, Yellow|Red $token): void
	{
		$this->tokens[$column] = $token;
	}
	
	public function getTokenByIndex(int $index): Yellow|Red|null
	{
		return $this->tokens[$index] ?? null;
	}
	public function getColumn(int $column): Yellow|Red|null
	{
		return $this->tokens[$column];
	}

	public function getTokens(): array
	{
		return $this->tokens;
	}

	public function setTokens(array $tokens): void
	{
		$this->tokens = $tokens;
	}


}