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
	return 's';
}

class ConnectFour
{
	const array ROWTOINT = [
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

	public function dropTokensInField():void
	{
		foreach ($this->input as $input) {
			$this->board->dropToken($input);
		}
	}
}

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
class Red
{

}

class Yellow
{

}

class Board {
	/* @var Row[] $board */
	private array $board = [];
	private const ROWCOUNT = 6;

	public function __construct()
	{
		for ($i = 0; $i < self::ROWCOUNT; $i++) {
			$this->board[] = new Row;
		}
	}

	public function dropToken(Input $token):void
	{
		$column = $token->getColumn();
		$row = 0;
		
		foreach ($this->board as $index =>$row) {
			if ($row->getColumn($column) === null) {
				$row = $index;
				break;
			}
		}

		$this->board[$row]->addToken($column, $token->getToken());
	}
}

class Row {

	/** @var Yellow|Red[] $tokens */
	private array $tokens = [];
	public function addToken(int $column, Yellow|Red $token): void
	{
		$this->tokens[$column] = $token;
	}

	public function getColumn(int $column): Yellow|Red|null
	{
		return $this->tokens[$column];
	}
}