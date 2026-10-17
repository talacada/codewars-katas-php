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
				if ($value != '-') {
					$stream[] = new Operator($value);
				}else {
					if ($stream[array_key_last($stream)] instanceof Operator || $stream[array_key_last($stream)] instanceof BracketSolo ||$stream === []) {
						if (!$stream[array_key_last($stream)] instanceof BracketSolo) {
							$stream[] = new Number($value);
						}else {
							if ($stream[array_key_last($stream)]->isOpening() === true) {
								$stream[] = new Number($value);
							}else {
								$stream[] = new Operator($value);
							}
						}
					}
				}
			}elseif (in_array($value, ['(', ')'])) {
				if ($value === ')') {
					$stream[] = new BracketSolo($value);
				}else {
					if ($stream[array_key_last($stream)] instanceof Number && $stream[array_key_last($stream)]->getValue() != '-') {
						$stream[array_key_last($stream)] = new Number('-1');
						$stream[] = new Operator('*');
						$stream[] = new BracketSolo($value);
					}else {
						$stream[] = new BracketSolo($value);
					}
				}
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
		$this->getBraceletsPairs();
		$this->transformBracketSoloToFullBrackets();
		$singleOperation = $this->getCalculationOrder($this->stream);
	}

	private function getBraceletsPairs(): void
	{
		$haveMoreBracelets = true;
		while ($haveMoreBracelets) {
			$braceletStartIndex = $this->getFirstNotUsedOpeningBraceletIndex();

			if ($braceletStartIndex !== false) {
				$braceletEndIndex = $this->getClosingBraceletIndex($braceletStartIndex);
				$spaceBetween = $braceletEndIndex - $braceletStartIndex;
				$this->stream[$braceletStartIndex]->setPairBracketIndex($spaceBetween);
				$this->stream[$braceletEndIndex]->setPairBracketIndex(-$spaceBetween);
			}else {
				$haveMoreBracelets = false;
			}
		}
	}

	private function getFirstNotUsedOpeningBraceletIndex(): int|false
	{
		foreach ($this->stream as $index => $stream) {
			if ($stream instanceof BracketSolo && $stream->getPairBracketIndex() === null && $stream->isOpening() === true) {
				return $index;
			}
		}

		return false;
	}

	private function getClosingBraceletIndex(int $braceletStartIndex): int
	{
		$haveBetweenBracelets = 0;
		for ($i = $braceletStartIndex + 1; $i < count($this->stream); $i++) {
			if ($this->stream[$i] instanceof BracketSolo) {
				if ($this->stream[$i]->isOpening() === false) {
					if ($haveBetweenBracelets === 0) {
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

/*	private function calculateInsideBracelets(array $inputOperation): array|Number
	{
		$index = 0;

		if (count($inputOperation) === 1 && $inputOperation[0] instanceof Number) {
			return $inputOperation[0];
		}

		while ($index < count($inputOperation)) {
			if ($inputOperation[$index] instanceof BracketSolo && $inputOperation[$index]->isOpening() === true) {
				$start = $index;
				$braceletLength = $inputOperation[$index]->getPairBracketIndex();
				$inputOperation[$index] = $this->calculateInsideBracelets(array_slice(
					$inputOperation, $start + 1, $braceletLength - 1
				));
				for ($u = $start + 1; $u <= $index + $braceletLength; $u++) {
					unset($inputOperation[$u]);
				}
				$index = $index + $braceletLength;
			}else {
				$index++;
			}
		}

		return $inputOperation;

	}*/

	private function transformBracketSoloToFullBrackets(): void
	{
		for ($index = 0; $index < count($this->stream); $index++) {
			if ($this->stream[$index] instanceof BracketSolo && $this->stream[$index]->isOpening() === true) {

				$braceletLength = $this->stream[$index]->getPairBracketIndex();
				$inside = $this->getInsideBracket(array_slice($this->stream, $index + 1, $braceletLength - 1));

				// Deleting old indexes, were moved inside Bracket
				for ($u = $index; $u <= $index + $braceletLength; $u++) {
					unset($this->stream[$u]);
				}

				$this->stream[$index] = $inside;
			}
		}

		ksort($this->stream);
		$this->stream = array_values($this->stream);
	}

	private function getInsideBracket(array $inside): Bracket|Number
	{
		for ($index = 0; $index < count($inside); $index++) {
			if ($inside[$index] instanceof BracketSolo) {
				$start = $index;
				$braceletLength = $inside[$index]->getPairBracketIndex();
				$insideInside = $this->getInsideBracket(array_slice($inside, $start + 1, $braceletLength - 1));

				// Deleting old indexes, were moved inside Bracket
				for ($u = $index; $u <= $index + $braceletLength; $u++) {
					unset($inside[$u]);
				}

				$inside[$start] = $insideInside;
			}
		}

		// Only one number inside brackets (-5) -> [Number]
		if (count($inside) === 1) {
			return $inside[0];
		}else {
			ksort($inside);
			$inside = array_values($inside);

			$bracket = new Bracket();
			$bracket->setInside($inside);
			return $bracket;
		}
	}

	private function getCalculationOrder(array $stream): array
	{
		foreach ($stream as $index => $value) {
			if (is_array($value)) {
				$stream[$index] = $this->getCalculationOrder($value);
			}
		}

		$havePriorityOneOperators = true;
		$operations = [];
		while ($havePriorityOneOperators) {
			$stream = array_values($stream);
			$index = false;
			foreach ($stream as $index => $value) {
				if ($value instanceof Operator) {
					if ($value->getPriority() === 0) {
						break;
					}
				}
				$index = false;
			}
			if ($index !== false) {
				$operation = new CalculationOperation();

				$operation->setValueLeft($stream[$index - 1]);
				$operation->setOperator($stream[$index]);
				$operation->setValueRight($stream[$index + 1]);

				$stream[$index] = $operation;

				unset($stream[$index - 1]);
				unset($stream[$index + 1]);
			}else {
				$havePriorityOneOperators = false;
			}
		}
		return $operations;
	}
}

class Number
{
	private float $value;
	private string $stringValue;
	private bool $usedInSearch = false;

	public function __construct(string $value){
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

}
class Operator
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

	public function getOperator(): string
	{
		return $this->operator;
	}

	public function setOperator(string $operator): void
	{
		$this->operator = $operator;
	}

	public function getPriority(): int
	{
		return $this->priority;
	}

	public function setPriority(int $priority): void
	{
		$this->priority = $priority;
	}

	public function isUsedInSearch(): bool
	{
		return $this->usedInSearch;
	}

	public function setUsedInSearch(bool $usedInSearch): void
	{
		$this->usedInSearch = $usedInSearch;
	}


}

class BracketSolo
{
	private bool $opening;
	private ?int $pairBracketIndex = null;

	public function __construct($value)
	{
		if ($value === '(') {
			$this->opening = true;
		}else {
			$this->opening = false;
		}
	}

	public function isOpening(): bool
	{
		return $this->opening;
	}

	public function setOpening(bool $opening): void
	{
		$this->opening = $opening;
	}

	public function getPairBracketIndex(): int|null
	{
		return $this->pairBracketIndex;
	}

	public function setPairBracketIndex(int $pairBracketIndex): void
	{
		$this->pairBracketIndex = $pairBracketIndex;
	}
}

class Bracket
{
	private array $inside;
	private int $result;

	public function getInside(): array
	{
		return $this->inside;
	}

	public function setInside(array $inside): void
	{
		$this->inside = $inside;
	}

	public function getResult(): int
	{
		return $this->result;
	}

	public function setResult(int $result): void
	{
		$this->result = $result;
	}
}

class CalculationOperation {

	private CalculationOperation|Number|null $valueLeft = null;
	private Operator $operator;
	private CalculationOperation|Number|null $valueRight = null;

	public function __construct($valueLeft = null)
	{
		$this->valueLeft = $valueLeft;
	}

	public function getValueLeft(): Number|CalculationOperation
	{
		return $this->valueLeft;
	}

	public function setValueLeft(Number|CalculationOperation $valueLeft): void
	{
		$this->valueLeft = $valueLeft;
	}

	public function getOperator(): Operator
	{
		return $this->operator;
	}

	public function setOperator(Operator $operator): void
	{
		$this->operator = $operator;
	}

	public function getValueRight(): Number|CalculationOperation
	{
		return $this->valueRight;
	}

	public function setValueRight(Number|CalculationOperation $valueRight): void
	{
		$this->valueRight = $valueRight;
	}

	public function setNextValue(Number|CalculationOperation $value): bool
	{
		if($this->valueLeft !== null){
			$this->valueLeft = $value;
			return true;
		}elseif($this->valueRight !== null){
			$this->valueRight = $value;
			return true;
		}else {
			return false;
		}
	}


}