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


function permutations(string $string): array {
	$possibleInputs = str_split($string);
	$result = array_fill(0, count($possibleInputs), null);

	$result = flatten(permutate($result, $possibleInputs));

	return array_unique($result);
}

function permutate(array $inputArray, array $possibleInputs): array
{
	if (empty($inputArray)) {
		return [''];
	}
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
			//If I made this return flat array I wouldn't need the flatten function
			$recursionBranch[] = permutate($inputArray, $possibleInputsThisCycle);
		}
	}

	return $recursionBranch;
}

function flatten(array $nestedArray): array
{
	$return = array();
	foreach ($nestedArray as $value) {
		if (isset($value[0][0]) && is_array($value[0][0])) {
			foreach ($value as $subvalue) {
				$return = array_merge($return, flatten($subvalue));
			}
		}else {
			if (isset($value[0]) && is_array($value[0])) {
				foreach ($value as $subvalue) {
					$string = implode($subvalue);
					$return[] = $string;
				}
			}elseif (is_string($value)) {
				$return[] = $value;
			}
			else {
				$string = implode($value);
				$return[] = $string;
			}

		}
	}
	return $return;
}
