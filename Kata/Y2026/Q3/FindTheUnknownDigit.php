<?php

declare(strict_types=1);

/*

To give credit where credit is due: This problem was taken from the ACMICPC-Northwest Regional Programming Contest. Thank you problem writers.

You are helping an archaeologist decipher some runes. He knows that this ancient society used a Base 10 system, and that they never start a number with a leading zero. He's figured out most of the digits as well as a few operators, but he needs your help to figure out the rest.

The professor will give you a simple math expression, of the form

[number][op][number]=[number]
He has converted all of the runes he knows into digits. The only operators he knows are addition (+),subtraction(-), and multiplication (*), so those are the only ones that will appear. Each number will be in the range from -1000000 to 1000000, and will consist of only the digits 0-9, possibly a leading -, and maybe a few ?s. If there are ?s in an expression, they represent a digit rune that the professor doesn't know (never an operator, and never a leading -). All of the ?s in an expression will represent the same digit (0-9), and it won't be one of the other given digits in the expression. No number will begin with a 0 unless the number itself is 0, therefore 00 would not be a valid number.

Given an expression, figure out the value of the rune represented by the question mark. If more than one digit works, give the lowest one. If no digit works, well, that's bad news for the professor - it means that he's got some of his runes wrong. output -1 in that case.

Complete the method to solve the expression to find the value of the unknown rune. The method takes a string as a paramater repressenting the expression and will return an int value representing the unknown rune or -1 if no such rune exists.

Most of the time, the professor will be able to figure out most of the runes himself, but sometimes, there may be exactly 1 rune present in the expression that the professor cannot figure out (resulting in all question marks where the digits are in the expression) so be careful ;)

https://www.codewars.com/kata/546d15cebed2e10334000ed9
*/

namespace Kata\Y2026\Q3;

class FindTheUnknownDigit
{
	private Formula $formula;

	public function __construct(string $formula){
		$this->formula = new Formula();
		$this->formula->populateFromString($formula);
	}

	public function decipher(): int
	{
		for ($i = 0; $i < 10; $i++) {
			$newData = str_replace("?", (string)$i, [$this->formula->numberOne, $this->formula->numberTwo, $this->formula->result]);
			$mutatedFormula = new Formula();
			$mutatedFormula->populateFromMutatedData($newData, $this->formula->operator);
			if ($mutatedFormula->calculateIfCorrect()) {
				return $i;
			}
		}

		return -1;
	}
}

class Formula
{
	public string $numberOne;
	public string $operator;
	public string $numberTwo;
	public string $result;
	const OPERANDS = ['-', '+', '*', '='];
	public function populateFromString(string $formula): void
	{
		[$this->numberOne, $this->operator, $this->numberTwo, $this->result] = $this->segmentateFormula($formula);
	}

	public function populateFromMutatedData(array $mutatedNumbers, string $operator): void
	{
		$this->numberOne = $mutatedNumbers[0];
		$this->operator = $operator;
		$this->numberTwo = $mutatedNumbers[1];
		$this->result = $mutatedNumbers[2];
	}

	private function segmentateFormula(string $formula): array
	{
		$return = [];
		$nowOn = 'number';
		$lastWasMinus = false;
		$formulaChars = str_split($formula);
		$previousIndex = 0;

		if ($formulaChars[0] === '-') {
			$lastWasMinus = true;
			$nowOn = 'operator';
		}

		foreach ($formulaChars as $index => $formulaChar) {
			if ($nowOn === 'number') {
				if (is_numeric($formulaChar) || $formulaChar === '?') {
					$return[$previousIndex] .= $formulaChar;
				}elseif (in_array($formulaChar, self::OPERANDS)) {
					$nowOn = 'operator';
					if ($formulaChar === '=') {
						continue;
					}
					$previousIndex ++;
					$return[] = $formulaChar;
				}
			}elseif ($nowOn === 'operator') {
				if (is_numeric($formulaChar) || $formulaChar === '?') {
					if ($lastWasMinus) {
						$return[$previousIndex] .= $formulaChar;
					}else {
						$return[] = $formulaChar;
						$previousIndex ++;
					}
					$nowOn = 'number';
				}elseif ($formulaChar === '-' && $lastWasMinus === true) {
					$return[] = $formulaChar;
					if ($index != 0) {
						$previousIndex ++;
					}
				}
			}
		}

		return $return;
	}

	public function calculateIfCorrect(): bool
	{
		$computed = match ($this->operator) {
			'+' => (int)$this->numberOne + (int)$this->numberTwo,
			'-' => (int)$this->numberOne - (int)$this->numberTwo,
			'*' => (int)$this->numberOne * (int)$this->numberTwo,
		};

		if ($computed === (int)$this->result) {
			return true;
		}else {
			return false;
		}
	}
}
