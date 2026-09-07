<?php

declare(strict_types=1);

/*
Write a function that accepts a square matrix (N x N 2D array) and returns the determinant of the matrix.

How to take the determinant of a matrix -- it is simplest to start with the smallest cases:

A 1x1 matrix |a| has determinant a.

A 2x2 matrix [ [a, b], [c, d] ] or

|a  b|
|c  d|
has determinant: a*d - b*c.

The determinant of an n x n sized matrix is calculated by reducing the problem to the calculation of the determinants of n matrices ofn-1 x n-1 size.

For the 3x3 case, [ [a, b, c], [d, e, f], [g, h, i] ] or

|a b c|
|d e f|
|g h i|
the determinant is: a * det(a_minor) - b * det(b_minor) + c * det(c_minor) where det(a_minor) refers to taking the determinant of the 2x2 matrix created by crossing out the row and column in which the element a occurs:

|- - -|
|- e f|
|- h i|
Note the alternation of signs.

The determinant of larger matrices are calculated analogously, e.g. if M is a 4x4 matrix with first row [a, b, c, d], then:

det(M) = a * det(a_minor) - b * det(b_minor) + c * det(c_minor) - d * det(d_minor)

https://www.codewars.com/kata/52a382ee44408cea2500074c
*/

namespace Kata\Y2026\Q3\MatrixDeterminant;

function determinant(array $matrix): int
{
    $calculator = new MatrixDeterminant($matrix);
    return $calculator->getResult();
}

class MatrixDeterminant
{
    private array $matrix;
    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    public function getResult(): int
    {
        return $this->getAllDeterminants($this->matrix);
    }

    private function makeMatrixSmaller(array $matrix, int $column): array
    {
        unset($matrix[0]);

        $newMatrix = [];
        foreach ($matrix as $row) {
            unset($row[$column]);
            $row = array_values($row);
            $newMatrix[] = $row;
        }

        return $newMatrix;
    }

    private function getAllDeterminants(array $matrix): int
    {
        if (count($matrix) === 1) {
            return $matrix[0][0];
        }
        if (count($matrix) === 2) {
            return ($matrix[0][0] * $matrix[1][1]) - ($matrix[0][1] * $matrix[1][0]);
        }

        $partialDeterminants = [];

        for ($i = 0; $i < count($matrix); $i++) {
            $smallerArray = $this->makeMatrixSmaller($matrix, $i);
            $partialDeterminants[] = $this->getAllDeterminants($smallerArray);
        }

        return $this->getPartialDeterminant($partialDeterminants, $matrix);
    }

    private function getPartialDeterminant(array $partialDeterminants, array $matrix): int
    {
        if (count($partialDeterminants) === 1) {
            return $partialDeterminants[0];
        }

        $operator = 1;
        $determinant = 0;
        for ($i = 0; $i < count($partialDeterminants); $i++) {
            $determinant += $operator * $partialDeterminants[$i] * $matrix[0][$i];
            $operator = -$operator;
        }

        return $determinant;
    }
}
