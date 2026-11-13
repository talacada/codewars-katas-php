<?php

declare(strict_types=1);

namespace Y2026\Q4\ConnectFour;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/ConnectFour.php';
use function Kata\Y2026\Q4\ConnectFour\whoIsWinner;
class ConnectFourTest extends TestCase
{
	public function testBasic() {
		$this->assertSame(whoIsWinner([
			"A_Red", "A_Yellow", "B_Yellow", "B_Red", "C_Yellow", "C_Yellow", "C_Red", "D_Yellow", "D_Yellow", "D_Yellow", "D_Red",
		]),
			"Red"
		);
		$this->assertSame(whoIsWinner([
			"A_Yellow", "A_Yellow", "A_Yellow", "A_Red", "B_Yellow", "B_Yellow", "B_Red", "C_Yellow", "C_Red", "D_Red",
		]),
			"Red"
		);

		$this->assertSame(whoIsWinner([
			"A_Yellow", "A_Yellow", "A_Red", "A_Red", "B_Yellow", "B_Yellow", "B_Yellow", "B_Yellow",
		]),
			"Yellow"
		);

		$this->assertSame(whoIsWinner([
			"A_Yellow", "B_Yellow", "C_Red", "C_Yellow", "D_Yellow", "A_Yellow", "B_Yellow", "D_Yellow",
		]),
			"Yellow"
		);

		$this->assertSame(whoIsWinner([
			"C_Yellow", "E_Red", "G_Yellow", "B_Red",
			"D_Yellow", "B_Red", "B_Yellow", "G_Red",
			"C_Yellow", "C_Red", "D_Yellow", "F_Red",
			"E_Yellow", "A_Red", "A_Yellow", "G_Red",
			"A_Yellow", "F_Red", "F_Yellow", "D_Red",
			"B_Yellow", "E_Red", "D_Yellow", "A_Red",
			"G_Yellow", "D_Red", "D_Yellow", "C_Red"
		]),
			"Yellow"
		);
		$this->assertSame(whoIsWinner([
			"C_Yellow", "B_Red", "B_Yellow", "E_Red",
			"D_Yellow", "G_Red", "B_Yellow", "G_Red",
			"E_Yellow", "A_Red", "G_Yellow", "C_Red",
			"A_Yellow", "A_Red", "D_Yellow", "B_Red",
			"G_Yellow", "A_Red", "F_Yellow", "B_Red",
			"D_Yellow", "A_Red", "F_Yellow", "F_Red",
			"B_Yellow", "F_Red", "F_Yellow", "G_Red",
			"A_Yellow", "F_Red", "C_Yellow", "C_Red",
			"G_Yellow", "C_Red", "D_Yellow", "D_Red",
			"E_Yellow", "D_Red", "E_Yellow", "C_Red",
			"E_Yellow", "E_Red"
		]),
			"Yellow"
		);
		$this->assertSame(whoIsWinner([
			"A_Red", "B_Yellow", "A_Red", "B_Yellow",
			"A_Red", "B_Yellow", "G_Red", "B_Yellow"
		]),
			"Yellow"
		);
		$this->assertSame(whoIsWinner([
			"A_Red", "B_Yellow", "A_Red", "E_Yellow",
			"F_Red", "G_Yellow", "A_Red", "G_Yellow"
		]),
			"Draw"
		);
		$this->assertSame(whoIsWinner([
			"A_Yellow", "B_Red", "B_Yellow", "C_Red",
			"G_Yellow", "C_Red", "C_Yellow", "D_Red",
			"G_Yellow", "D_Red", "G_Yellow", "D_Red",
			"F_Yellow", "E_Red", "D_Yellow"
		]),
			"Red"
		);
		$this->assertSame(whoIsWinner([
			"F_Yellow", "G_Red", "D_Yellow", "C_Red",
			"A_Yellow", "A_Red", "E_Yellow", "D_Red",
			"D_Yellow", "F_Red", "B_Yellow", "E_Red",
			"C_Yellow", "D_Red", "F_Yellow", "D_Red",
			"D_Yellow", "F_Red", "G_Yellow", "C_Red",
			"F_Yellow", "E_Red", "A_Yellow", "A_Red",
			"C_Yellow", "B_Red", "E_Yellow", "C_Red",
			"E_Yellow", "G_Red", "A_Yellow", "A_Red",
			"G_Yellow", "C_Red", "B_Yellow", "E_Red",
			"F_Yellow", "G_Red", "G_Yellow", "B_Red",
			"B_Yellow", "B_Red"
		]),
			"Red"
		);
	}
}
