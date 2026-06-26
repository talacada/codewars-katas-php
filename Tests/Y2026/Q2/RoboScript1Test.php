<?php

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../../Kata/Y2026/Q2/RoboScript1.php';
use function Kata\Y2026\Q2\highlight;

class RoboScript1Test extends TestCase {
	public function testDescriptionExamples() {
		//echo "Code without syntax highlighting: F3RF5LF7\r\n";
		//echo "Expected syntax highlighting: <span style=\"color: pink\">F</span><span style=\"color: orange\">3</span><span style=\"color: green\">R</span><span style=\"color: pink\">F</span><span style=\"color: orange\">5</span><span style=\"color: red\">L</span><span style=\"color: pink\">F</span><span style=\"color: orange\">7</span>\r\n";
		//echo "Your code with syntax highlighting: " . highlight("F3RF5LF7") . "\r\n";
		$this->assertSame("<span style=\"color: pink\">F</span><span style=\"color: orange\">3</span><span style=\"color: green\">R</span><span style=\"color: pink\">F</span><span style=\"color: orange\">5</span><span style=\"color: red\">L</span><span style=\"color: pink\">F</span><span style=\"color: orange\">7</span>", highlight("F3RF5LF7"));
		//echo "Code without syntax highlighting: FFFR345F2LL\r\n";
		//echo "Expected syntax highlighting: <span style=\"color: pink\">FFF</span><span style=\"color: green\">R</span><span style=\"color: orange\">345</span><span style=\"color: pink\">F</span><span style=\"color: orange\">2</span><span style=\"color: red\">LL</span>\r\n";
		//echo "Your code with syntax highlighting: " . highlight("FFFR345F2LL") . "\r\n";
		$this->assertSame("<span style=\"color: pink\">FFF</span><span style=\"color: green\">R</span><span style=\"color: orange\">345</span><span style=\"color: pink\">F</span><span style=\"color: orange\">2</span><span style=\"color: red\">LL</span>", highlight("FFFR345F2LL"));
	}
}
