<?php

namespace Kata\Y2026\Q4\EvaluateMathematicalExpression;

function calc(string $expression): float {
	$calculator = new EvaluateMathematicalExpression($expression);
	$calculator->getResult();
}
class EvaluateMathematicalExpression
{
	public function __construct(string $expression) {
		str_replace(' ', '', $expression);
		$splitExpression = str_split($expression);

		foreach ($splitExpression as $expression) {

		}
	}
	public function getResult(): int|float
	{
	}
}

class Number
{
	private int|float $value;

	public function getValue(): float
	{
		return $this->value;
	}

	public function setValue(float $value): void
	{
		$this->value = $value;
	}

	public function addToValue(string $value): void
	{
		$string = (string)$this->value . $value;
		$this->value = $string;
	}
}
class Operator
{

}

class Braclet
{

}