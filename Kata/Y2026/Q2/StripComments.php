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
	$explodedString = explode("\n", $str);
	$arrayWithoutComments = [];

	foreach ($explodedString as $line) {
		$found = false;
		$markerIndex = [];//test

		foreach ($markers as $marker) {
			$index = strpos($line, $marker);
			if ($index !== false) {
				$markerIndex[] = $index;
			}
		}
		asort($markerIndex);
		$markerIndex = array_values($markerIndex);

		if (isset($markerIndex[0]) && $markerIndex[0] !== false) {
			$line = substr($line, 0, $markerIndex[0]);
			$line = rtrim($line);
			$arrayWithoutComments[] = $line;
			$found = true;
		}

		if (!$found) {
			$arrayWithoutComments[] = $line;
		}
	}
	return implode("\n", $arrayWithoutComments);
}

class StripComments extends TestCase
{
	public function testSample()
	{
		$this->assertSame("avocados cherries \noranges avocados \n? pears - oranges ' \navocados pears pears \n",
			stripComments("avocados cherries \noranges avocados \n? pears - oranges ' \navocados pears pears \n", [',', '^']));
		$this->assertSame("apples, pears\ngrapes\nbananas", stripComments("apples, pears # and bananas\ngrapes\nbananas !apples", ['#', '!']));
		$this->assertSame("apples, pears\ngrapes\nbananas", stripComments("apples, pears # and bananas\ngrapes\nbananas !#apples", ['#', '!']));
		$this->assertSame("a\nc\nd", stripComments("a #b\nc\nd \$e f g", ['#', '$']));
		$this->assertSame(" a\nc\nd", stripComments(" a #b\nc\nd \$e f g", ['#', '$']));
	}
	
}
