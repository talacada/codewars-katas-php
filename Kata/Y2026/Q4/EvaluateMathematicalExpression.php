<?php

/*
Instructions
Given a mathematical expression as a string you must return the result as a number.

Numbers
Number may be both whole numbers and/or decimal numbers. The same goes for the returned result.

Operators
You need to support the following mathematical operators:

Multiplication *
Division / (as floating point division)
Addition +
Subtraction -
Operators are always evaluated from left-to-right, and * and / must be evaluated before + and -.

Parentheses
You need to support multiple levels of nested parentheses, ex. (2 / (2 + 3.33) * 4) - -6

Whitespace
There may or may not be whitespace between numbers and operators.

An addition to this rule is that the minus sign (-) used for negating numbers and parentheses will never be separated by whitespace. I.e all of the following are valid expressions.

1-1    // 0
1 -1   // 0
1- 1   // 0
1 - 1  // 0
1- -1  // 2
1 - -1 // 2
1--1   // 2

6 + -(4)   // 2
6 + -( -4) // 10
And the following are invalid expressions

1 - - 1    // Invalid
1- - 1     // Invalid
6 + - (4)  // Invalid
6 + -(- 4) // Invalid
Validation
You do not need to worry about validation - you will only receive valid mathematical expressions following the above rules.

Restricted APIs
NOTE: eval is disallowed in your solution.

https://www.codewars.com/kata/52a78825cdfc2cfc87000005
*/

namespace Kata\Y2026\Q4\EvaluateMathematicalExpression;

function calc(string $expression): float {
	$calculator = new EvaluateMathematicalExpression($expression);
	$calculator->getResult();
}
class EvaluateMathematicalExpression
{
	private array $stream;

	public function __construct(string $expression) {
		$expression = str_replace(' ', '', $expression);
		$splitExpression = str_split($expression);

		$stream = [];
		foreach ($splitExpression as $value) {
			if (in_array($value, ['+', '-', '*', '/'])) {
				$stream[] = new Operator($value);
			}elseif (in_array($value, ['(', ')'])) {
				$stream[] = new Braclet($value);
			}else {
				if (end($stream) instanceof Number) {
					$stream[array_key_last($stream)]->addToValue($value);
				}else{
					$stream[] = new Number($value);
				}
			}
		}
		
		$this->stream = $stream;
	}
	public function getResult(): float
	{
		$calculationOrder = $this->getOrderLogicalCalculationOrderByOperatorsAndBracelets($this->stream);
	}

	private function getOrderLogicalCalculationOrderByOperatorsAndBracelets(array $stream): CalculationOperation
	{
		$haveMoreBracelets = true;
		while ($haveMoreBracelets) {
			$braceletStartIndex = $this->getFirstNotUsedOpeningBraceletIndex();

			if ($braceletStartIndex !== false) {
				$braceletEndIndex = $this->getClosingBraceletIndex($braceletStartIndex);
				//TODO tady tedy budu vedet cely obsah jedne zavorky
			}else {
				$haveMoreBracelets = false;
			}

		}
	}

	private function getFirstNotUsedOpeningBraceletIndex(): int|false
	{
		foreach ($this->stream as $index => $stream) {
			if ($stream instanceof Braclet && $stream->getUsedInSearch() === false && $stream->isOpening() === true) {
				$stream->setUsedInSearch(true);
				return $index;
			}
		}

		return false;
	}

	private function getClosingBraceletIndex(int $braceletStartIndex)
	{
		$haveBetweenBracelets = 0;
		for ($i = $braceletStartIndex + 1; $i < count($this->stream); $i++) {
			if ($this->stream[$i] instanceof Braclet) {
				if ($this->stream[$i]->isOpening() === false) {
					if ($haveBetweenBracelets === 0) {
						$this->stream[$i]->setUsedInSearch(true);
						return $i;
					}else{
						$haveBetweenBracelets--;
					}
				}else {
					$haveBetweenBracelets++;
				}
			}
		}
	}
}

class Number implements UsedInterface
{
	private float $value;
	private string $stringValue;
	private bool $usedInSearch = false;

	public function __construct(float $value){
		$this->stringValue = $value;
	}

	public function getValue(): float
	{
		return floatval($this->stringValue);
	}

	public function addToValue(string $value): void
	{
		$this->stringValue .= $value;
	}

	public function getUsedInSearch(): bool
	{
		// TODO: Implement getUsedInSearch() method.
	}

	public function setUsedInSearch(bool $usedInSearch): void
	{
		// TODO: Implement setUsedInSearch() method.
	}
}
class Operator implements UsedInterface
{
	private string $operator;
	private int $priority;
	private bool $usedInSearch = false;

	public function __construct(string $operator) {
		$this->operator = $operator;
		if (in_array($operator, ['+', '-'])) {
			$this->priority = 1;
		}else {
			$this->priority = 0;
		}
	}

	public function getUsedInSearch(): bool
	{
		// TODO: Implement getUsedInSearch() method.
	}

	public function setUsedInSearch(bool $usedInSearch): void
	{
		// TODO: Implement setUsedInSearch() method.
	}
}

class Braclet implements UsedInterface
{
	private bool $opening;
	private bool $usedInSearch = false;

	public function __construct($value)
	{
		if ($value === '(') {
			$this->opening = true;
		}else {
			$this->opening = false;
		}
	}

	public function getUsedInSearch(): bool
	{
		return $this->usedInSearch;
	}

	public function setUsedInSearch(bool $usedInSearch): void
	{
		$this->usedInSearch = $usedInSearch;
	}

	public function isOpening(): bool
	{
		return $this->opening;
	}

	public function setOpening(bool $opening): void
	{
		$this->opening = $opening;
	}
}

interface UsedInterface {
	public function getUsedInSearch(): bool;
	public function setUsedInSearch(bool $usedInSearch): void;
}

class CalculationOperation {

}