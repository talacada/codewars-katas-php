<?php

declare(strict_types=1);

namespace Y2026\Q4;

use Kata\Y2026\Q4\Sq2Squares;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/Sq2Squares.php';

class NewKataTest extends TestCase
{
	function revTest($n, $exp) {
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
		$this->revTest(50, [1,3,5,8,49]);
		$this->revTest(44, [2,3,5,7,43]);
		$this->revTest(2, null);
	}

}
