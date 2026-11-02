<?php

declare(strict_types=1);

namespace Y2026\Q4\JustifyText;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/JustifyText.php';
use function Kata\Y2026\Q4\JustifyText\justify;

class JustifyTextTest extends TestCase
{
	public function testExample() {
		$this->assertSame("This is\nan\nexample\nrow", justify("This is an example row", 7));
		$this->assertSame("This is\nan\nexample\nrow", justify("Thddis ids dddan exdample rodw an exampddddle rowd n exaddddmple rowan example row", 7));
	}
}
