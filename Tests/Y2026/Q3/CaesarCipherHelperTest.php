<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\CaesarCipherHelper;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/CaesarCipherHelper.php';

class CaesarCipherHelperTest extends TestCase
{
	public function testExamples() {
		$c = new CaesarCipherHelper(5);
		$this->assertSame($c->encode('Codewars'), 'HTIJBFWX');
		$this->assertSame($c->decode('Htijbfwx'), 'CODEWARS');
	}
}
