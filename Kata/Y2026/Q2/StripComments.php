<?php

/*
Complete the solution so that it strips all text that follows any of a set of comment markers passed in. Any whitespace at the end of the line should also be stripped out.

Example:

Given an input string of:

apples, pears # and bananas
grapes
bananas !apples
The output expected would be:

apples, pears
grapes
bananas

*/


namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function stripComments(string $str, array $markers): string
{
	return "";
}

class StripComments extends TestCase
{
	public function testSample()
	{
		// /n je nový řádek takže to resetuje ten commment
		$this->assertSame("apples, pears\ngrapes\nbananas", stripComments("apples, pears # and bananas\ngrapes\nbananas !apples", ['#', '!']));
		$this->assertSame("a\nc\nd", stripComments("a #b\nc\nd \$e f g", ['#', '$']));
		$this->assertSame(" a\nc\nd", stripComments(" a #b\nc\nd \$e f g", ['#', '$']));
	}
}
