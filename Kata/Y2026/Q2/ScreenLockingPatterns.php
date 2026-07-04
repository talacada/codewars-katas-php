<?php

declare(strict_types=1);

/*
Screen Locking Patterns
You might already be familiar with many smartphones that allow you to use a geometric pattern as a security measure. To unlock the device, you need to connect a sequence of dots/points in a grid by swiping your finger without lifting it as you trace the pattern through the screen.

The image below has an example pattern of 7 dots/points: (A -> B -> I -> E -> D -> G -> C).

lock_example.png

For this kata, your job is to implement a function that returns the number of possible patterns starting from a given first point, that have a given length.

More specifically, for a function countPatternsFrom(firstPoint, length), the parameter firstPoint is a single-character string corresponding to the point in the grid (e.g.: 'A') where your patterns start, and the parameter length is an integer indicating the number of points (length) every pattern must have.

For example, countPatternsFrom("C", 2), should return the number of patterns starting from 'C' that have 2 two points. The return value in this case would be 5, because there are 5 possible patterns:

(C -> B), (C -> D), (C -> E), (C -> F) and (C -> H).

Bear in mind that this kata requires returning the number of patterns, not the patterns themselves, so you only need to count them. Also, the name of the function might be different depending on the programming language used, but the idea remains the same.

Rules
In a pattern, the dots/points cannot be repeated: they can only be used once, at most.
In a pattern, any two subsequent dots/points can only be connected with direct straight lines in either of these ways:
Horizontally: like (A -> B) in the example pattern image.
Vertically: like (D -> G) in the example pattern image.
Diagonally: like (I -> E), as well as (B -> I), in the example pattern image.
Passing over a point between them that has already been 'used': like (G -> C) passing over E, in the example pattern image. This is the trickiest rule. Normally, you wouldn't be able to connect G to C, because E is between them, however when E has already been used as part the pattern you are tracing, you can connect G to C passing over E, because E is ignored, as it was already used once.

The sample tests have some examples of the number of combinations for some cases to help you check your code.

Haskell Note: A data type Vertex is provided in place of the single-character strings. See the solution setup code for more details.

Fun fact:

In case you're wondering out of curiosity, for the Android lock screen, the valid patterns must have between 4 and 9 dots/points. There are 389112 possible valid patterns in total; that is, patterns with a length between 4 and 9 dots/points.

https://www.codewars.com/kata/585894545a8a07255e0002f1
*/

namespace Kata\Y2026\Q2;

class ScreenLockingPatterns
{
    private array $grid;
    private array $startIndex;
    private mixed $finalLength;

    public function __construct(string $start, int $length)
    {
        $startLetter = ord(($start)) - ord('A');
        $this->startIndex[0] = intdiv($startLetter, 3);
        $this->startIndex[1] = $startLetter % 3;
        $this->grid = $this->createGrid();
        $this->finalLength = $length;
    }

    private function createGrid(): array
    {
        $grid = [
            [0, 0, 0],	// 	A  B  C
            [0, 0, 0],  //	D  E  F
            [0, 0, 0]	// 	G  H  I
        ];

        $grid[$this->startIndex[0]][$this->startIndex[1]] = 1;
        return $grid;
    }

    public function calculateFinalLength(): int
    {
        if ($this->finalLength < 1 || $this->finalLength > 9) {
            return 0;
        } elseif ($this->finalLength === 1) {
            return 1;
        }
        $count = $this->calculate($this->grid, $this->startIndex);

        return $count;
    }
    private function calculate(array $grid, array $on, int $nowOnLength = 1): int
    {
        $combinations = 0;
        $neighbours = [[1, 0], [-1, 0], [0, 1], [0, -1], [-1, -1], [-1, 1], [1, -1], [1, 1]];
        $cornerSuperDiagonals = [[-1, +2], [-2, +1], [-2, -1], [-1, -2], [+1, -2], [+1, +2], [+2, +1], [+2, -1]];
        $overCompleted = [[0, +2], [0, -2], [2, 0], [-2, 0], [2,2], [2,-2], [-2,2], [-2,-2]];
        $availableMoves = array_merge($neighbours, $cornerSuperDiagonals, $overCompleted);


        foreach ($availableMoves as $move) {
            $possibleFinalPosition = [$on[0] + $move[0], $on[1] + $move[1]];
            if (isset($grid[$possibleFinalPosition[0]][$possibleFinalPosition[1]])) {
                if ($grid[$possibleFinalPosition[0]][$possibleFinalPosition[1]] === 0) {
                    $possibleGridAfterMove = $grid;
                    $possibleGridAfterMove[$possibleFinalPosition[0]][$possibleFinalPosition[1]] = 1;
                    if (in_array($move, $overCompleted)) {
                        $betweenMove = [$move[0] / 2, $move[1] / 2];
                        $betweenMovePosition = [$on[0] + $betweenMove[0], $on[1] + $betweenMove[1]];
                        if ($possibleGridAfterMove[$betweenMovePosition[0]][$betweenMovePosition[1]] === 0) {
                            continue;
                        }
                    }

                    if ($nowOnLength < $this->finalLength - 1) {
                        $combinations += $this->calculate($possibleGridAfterMove, $possibleFinalPosition, $nowOnLength + 1);
                    } else {
                        $combinations++;
                    }
                }
            }
        }

        return $combinations;
    }
}
