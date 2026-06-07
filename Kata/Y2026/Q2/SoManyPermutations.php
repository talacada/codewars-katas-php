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

	$result = flatten(permutate($result, $possibleInputs));

	return $result;
}

//TODO stejne nedostavam vsechny mozne
function permutate(array $inputArray, array $possibleInputs): array
{
	$firstNullIndex = array_search(null, $inputArray, true);
	$recursionBranch = [];
	foreach ($possibleInputs as $input) {
		$inputArray[$firstNullIndex] = $input;
		$possibleInputsThisCycle = $possibleInputs;
		unset($possibleInputsThisCycle[array_search($input, $possibleInputs)]);
		$possibleInputsThisCycle = array_values($possibleInputsThisCycle);

		if (count($possibleInputsThisCycle) === 0) {
			return $inputArray;
		}else {
			$recursionBranch[] = permutate($inputArray, $possibleInputsThisCycle);
		}
	}

	return $recursionBranch;
}

// TODO neflateruje se to
function flatten(array $nestedArray): array
{
	$return = array();
	foreach ($nestedArray as $key => $value) {
		if (is_array($value[0])) {
			$return[] = flatten($value[0]);
		}else {
			$return[] = [];
			array_push($return[array_key_last($return)], ...$value);
		}
	}
	return $return;
}


final class SoManyPermutations extends TestCase {
	private function assertEquivalent(array $expected, array $actual, string $msg = ''): void
	{
		sort($expected);
		sort($actual);
		$this->assertSame($expected, $actual, $msg);
	}
	public function testDescriptionExamples() {
		$this->assertEquivalent([], permutations('abcd'));
		$this->assertEquivalent(['aabb', 'abab', 'abba', 'baab', 'baba', 'bbaa'], permutations('aabb'));
		$this->assertEquivalent(['a'], permutations('a'));
		$this->assertEquivalent(['ab', 'ba'], permutations('ab'));
	}
}