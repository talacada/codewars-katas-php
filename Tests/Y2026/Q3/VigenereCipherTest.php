<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\VigenèreCipher;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/VigenèreCipher.php';



class VigenereCipherTest extends TestCase
{
	public function test1() {
		$c = new VigenèreCipher('password', 'abcdefghijklmnopqrstuvwxyz');

		$this->assertSame('rovwsoiv', $c->encode('codewars'));
		$this->assertSame('codewars', $c->decode('rovwsoiv'));

		$this->assertSame('laxxhsj', $c->encode('waffles'));
		$this->assertSame('waffles', $c->decode('laxxhsj'));

		$this->assertSame('CODEWARS', $c->encode('CODEWARS'));
		$this->assertSame('CODEWARS', $c->decode('CODEWARS'));
	}
}
