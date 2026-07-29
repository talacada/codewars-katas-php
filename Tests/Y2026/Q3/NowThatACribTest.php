<?php

declare(strict_types=1);

namespace Y2026\Q3;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/NowThatACrib.php';

class NowThatACribTest extends TestCase
{
	public function testBasics(): void {
		$this->assertSame('  ___  \n /___\\ \n/_____\\\n|  _  |\n|_|_|_|', my_crib(1));
		$this->assertSame('    _____    \n   /_____\\   \n  /_______\\  \n /_________\\ \n/___________\\\n|           |\n|    ___    |\n|   |   |   |\n|___|___|___|', my_crib(2));
		$this->assertSame('      _______      \n     /_______\\     \n    /_________\\    \n   /___________\\   \n  /_____________\\  \n /_______________\\ \n/_________________\\\n|                 |\n|                 |\n|      _____      |\n|     |     |     |\n|     |     |     |\n|_____|_____|_____|', my_crib(3));
	}
}
