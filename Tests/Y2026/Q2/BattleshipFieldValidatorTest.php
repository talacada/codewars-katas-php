<?php

namespace Y2026\Q2;

use Kata\Y2026\Q2\BattleshipFieldValidator;
use PHPUnit\Framework\TestCase;

class BattleshipFieldValidatorTest extends TestCase
{
	public function testExample()
	{
		$this->assertTrue($this->validate_battlefield([
			[1, 0, 0, 0, 0, 1, 1, 0, 0, 0],
			[1, 0, 1, 0, 0, 0, 0, 0, 1, 0],
			[1, 0, 1, 0, 1, 1, 1, 0, 1, 0],
			[1, 0, 0, 0, 0, 0, 0, 0, 0, 0],
			[0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
			[0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
			[0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
			[0, 0, 0, 1, 0, 0, 0, 0, 0, 0],
			[0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
			[0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
		]));
	}

	function validate_battlefield(array $field): bool {
		$validator = new BattleshipFieldValidator($field);
		return $validator->isFieldValid();
	}
}
