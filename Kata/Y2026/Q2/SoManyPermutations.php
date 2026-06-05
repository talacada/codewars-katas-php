<?php

/*
In this kata, your task is to create all permutations of a non-empty input string and remove duplicates, if present.

Create as many "shufflings" as you can!

Examples:

With input 'a':
Your function should return: ['a']

With input 'ab':
Your function should return ['ab', 'ba']

With input 'abc':
Your function should return ['abc','acb','bac','bca','cab','cba']

With input 'aabb':
Your function should return ['aabb', 'abab', 'abba', 'baab', 'baba', 'bbaa']
Note: The order of the permutations doesn't matter.

Good luck!

https://www.codewars.com/kata/5254ca2719453dcc0b00027d
*/

namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function permutations(string $string): array {
	$possibleInputs = str_split($string);
	$result = array_fill(0, count($possibleInputs), null);

	$result = permutate($result, $possibleInputs);

	return $result;
}
/*
function permutate(array $result, array $possibleInputs): array
{
	$possibleInputs = array_values($possibleInputs);
	$result = array_reduce($result, function ($carry, $inputWithoutModifications) use ($possibleInputs) {
		$carry[] = array_reduce($possibleInputs, function ($carry, $input) use ($possibleInputs, $inputWithoutModifications) {
			$firstNullIndex = array_search(null, $inputWithoutModifications, true);
			$inputWithoutModifications[$firstNullIndex] = $input;
			$possibleInputsForRecursion = $possibleInputs;
			unset($possibleInputsForRecursion[0]);
			$recursionBranch = permutate($inputWithoutModifications, $possibleInputsForRecursion);
			$carry[] = $recursionBranch;
			return $carry;
		});
		return $carry;
	});
	return $result;
}*/
function permutate(array $inputArray, array $possibleInputs): array
{
	$possibleInputs = array_values($possibleInputs);
	$result = array_reduce($possibleInputs, function ($carry, $input) use ($possibleInputs, $inputArray) {
		$firstNullIndex = array_search(null, $inputArray, true);
		$inputArray[$firstNullIndex] = $input;
		$possibleInputsForRecursion = $possibleInputs;
		unset($possibleInputsForRecursion[0]);
		$recursionBranch[] = permutate($inputArray, $possibleInputsForRecursion);
		$carry[] = $recursionBranch;
		return $carry;
	});
	return $result;
}


final class SoManyPermutations extends TestCase {
	private function assertEquivalent(array $expected, array $actual, string $msg = ''): void
	{
		sort($expected);
		sort($actual);
		$this->assertSame($expected, $actual, $msg);
	}
	public function testDescriptionExamples() {
		$this->assertEquivalent(['aabb', 'abab', 'abba', 'baab', 'baba', 'bbaa'], permutations('aabb'));
		$this->assertEquivalent(['a'], permutations('a'));
		$this->assertEquivalent(['ab', 'ba'], permutations('ab'));
	}
}