<?php
namespace Y2026\Q2;

use Kata\Y2026\Q2\FormatDuration;
use PHPUnit\Framework\TestCase;

function format_duration(int $seconds): string {
	$formater = new FormatDuration($seconds);
	return $formater->getHumanReadableFormat();
}

class FormatDurationTest extends TestCase {
	public function testExample() {
		$this->assertSame("1 second", format_duration(1));
		$this->assertSame("1 minute and 2 seconds", format_duration(62));
		$this->assertSame("2 minutes", format_duration(120));
		$this->assertSame("1 hour", format_duration(3600));
		$this->assertSame("1 hour, 1 minute and 2 seconds", format_duration(3662));
	}
}