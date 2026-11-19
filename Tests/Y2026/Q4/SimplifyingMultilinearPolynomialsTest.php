<?php

declare(strict_types=1);

namespace Y2026\Q4;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/SimplifyingMultilinearPolynomials.php';
use function Kata\Y2026\Q4\SimplifyingMultilinearPolynomials\simplify;

class SimplifyingMultilinearPolynomialsTest extends TestCase
{
	// test function names should start with "test"
	public function test_reduction_by_equivalence()
	{
		$this->assertSame('cd+abcd', simplify('dc+dcba'));
		$this->assertSame('xy', simplify('2xy-yx'));
		$this->assertSame('-c+5ab', simplify('-a+5ab+3a-c-2a'));
	}

	public function test_monomial_length_ordering()
	{
		$this->assertSame('3a+2ac-abc', simplify('-abc+3a+2ac'));
		$this->assertSame('-xz+xyz', simplify('xyz-xz'));
	}

	public function test_lexicographic_ordering()
	{
		$this->assertSame('a-ab+ac', simplify('a+ca-ab'));
		$this->assertSame('byz+xyz', simplify('xzy+zby'));
	}

	public function test_no_leading_plus()
	{
		$this->assertSame('x-y', simplify('-y+x'));
		$this->assertSame('-x+y', simplify('y-x'));
	}
}
