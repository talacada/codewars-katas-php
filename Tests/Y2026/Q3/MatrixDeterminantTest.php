<?php

declare(strict_types=1);

namespace Y2026\Q3\MatrixDeterminant;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/MatrixDeterminant.php';

use function Kata\Y2026\Q3\MatrixDeterminant\determinant;

class MatrixDeterminantTest extends TestCase
{
	public function testExamples() {
		$this->assertSame(1, determinant([[1]]), 'Determinant of a 1 x 1 matrix should equal the value of its one and only element');
		$this->assertSame(-1, determinant([
			[1, 3],
			[2, 5]
		]), "Should return 1 * 5 - 3 * 2, i.e., -1");
		$this->assertSame(-20, determinant([
			[2, 5, 3],
			[1, -2, -1],
			[1, 3, 4]
		]), 'Should work for a 3 x 3 matrix');
	}
}
