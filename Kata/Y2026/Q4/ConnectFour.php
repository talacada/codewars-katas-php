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
	//return "Red", "Yellow" or "Draw"
}

class ConnectFour
{

}

class Input {
	private int $column;
	private Yellow|Red $token;
}
interface Token {

}
class Red implements Token
{

}

class Yellow implements Token
{

}