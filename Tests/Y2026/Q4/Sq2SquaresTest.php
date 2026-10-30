<?php

declare(strict_types=1);

namespace Y2026\Q4\Sq2Squares;

use Kata\Y2026\Q4\Sq2Squares\Sq2Squares;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/Sq2Squares.php';

class Sq2SquaresTest extends TestCase
{
	function revTest($n, $exp): void
	{
		$ans = Sq2Squares::decompose($n);
		$success = false;
		$sans = json_encode($ans);
		$sexp = json_encode($exp);
		echo("Expected: $sexp  Got:  $sans\n");
		if ($ans == $exp) {
			echo("Good\n");
			$success = true;
		} else {
			if ($ans == null) {
				$success = false;
			} else {
				$st = isSorted($ans);
				$t = sumSquares($ans, $n);
				echo("Sorted: $st Total: $t\n");
				if (($st == false) || ($t == false)) {
					echo("Not increasinly sorted or bad sum of squares\n");
					$success = false;
				}
				else { $success = true; echo("Good\n");}
			}
		}
		$this->assertSame($success, true);
	}
	public function testBasic() {
		$this->revTest(5, [3, 4]);
		$this->revTest(11, [1,2,4, 10]);
		$this->revTest(7, [2, 3, 6]);
		$this->revTest(2, null);
		$this->revTest(44, [2,3,5,7,43]);
		$this->revTest(50, [1,3,5,8,49]);
		$this->revTest(12, [1, 2, 3, 7, 9]);
		$this->revTest(625, [2, 5, 8, 34, 624]);
	}

	public function testRandom(): void
	{
		$numbers = [12345678];
		foreach ($numbers as $n) {
			$ans = Sq2Squares::decompose($n);
			$this->assertNotNull($ans, "decompose($n) should not return null");
			$this->assertTrue(isSorted($ans), "Array for $n should be strictly increasing");
			$this->assertTrue(sumSquares($ans, $n), "Sum of squares for $n should equal $n^2");
		}
	}
}

function isSorted(array $arr): bool
{
	for ($i = 0; $i < count($arr) - 1; $i++) {
		if ($arr[$i] >= $arr[$i + 1]) {
			return false;
		}
	}
	return true;
}
function sumSquares(array $arr, int $n): bool
{
	$sum = 0;
	foreach ($arr as $x) {
		$sum += $x * $x;
	}
	return $sum === $n * $n;
}