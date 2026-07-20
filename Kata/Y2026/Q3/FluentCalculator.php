<?php

/*
Fluent Calculator
Your task is to create a class that implements a simple calculator with fluent syntax:

FluentCalculator::one(); // 1
FluentCalculator::one->two->three(); // 123
FluentCalculator::one->plus->four(); // 5
FluentCalculator::one->plus->four->times->three(); // (1 + 4) * 3 = 15
Rules:
Names
Values are zero, one, two, three, four, five, six, seven, eight and nine.
Operations are plus, minus, times, dividedBy.
To make the task more interesting, FluentCalculator cannot declare public properties or methods with the name of an operation or the name of a digit.
Properties
Accessing a property of value and/or operation should be stackable to infinity,
Accessing a value more than once will stack the digits: for example one->two->three should yield 123.
Accessing an operation more than once will overwrite the previous operation (see example for more information),
Call to a value or operation should resolve to a primitive integer (round towards zero, i.e., truncate, if necessary) and returns the most recent calculation value.
Exceptions
There a 3 exception classes pre-defined for you in the preloaded section. Here are the exceptions that you must detect:

Accessing a property or call to a method other than values and operations should throw InvalidInputException. (Make sure to make your properties / methods private to avoid name clashes).
The calculator is limited to numbers with at most 9 digits. If the user tries to input more than 9 digits (not counting leading zeroes), or if some calculation returns a value whose absolute value is larger than or equal to 10 ** 9, throw a DigitCountOverflowException.
If a number is divided by zero, throw a DivisionByZeroException.
Evaluation must occur on each property access, not at once during the final method invocation. This means that you should detect errors as soon as they occur.
Initial state
The calculator is initialized as if by zero plus. This is relevant in some contexts: FluentCalculator::init()->one() is as-if 0 + 1, and FluentCalculator::init()->dividedBy->one() is as-if 0 / 1 (the plus being overwritten by dividedBy).
Examples:
FluentCalculator::init()->one();                   // should return 1
FluentCalculator::init()->one->zero();             // should return 10
FluentCalculator::init()->one->plus->two();        // should return 3 (1 + 2)

FluentCalculator::init()->one->two->three->four->five->six->seven->eight->nine->zero();
// should throw DigitCountOverflowException since the input is more than 9 digit (1,234,567,890)

FluentCalculator::init()->nine->nine->nine->nine->nine->nine->nine->nine->nine->plus->one();
// should throw DigitCountOverflowException since the calculation will result more than 9 digit (999,999,999 + 1 = 1,000,000,000)

FluentCalculator::init()->one->plus->minus->two();
// returns -1 (operation "plus" is overwriten by "minus")

FluentCalculator::init()->one->add->two();
// should throw InvalidInputException since there is no value/operation named "add"

FluentCalculator::init()->one->plus->two->dividedBy->three->times->one->zero->minus->three->plus->eight();
/* should return 15
 * input: 1 + 2 / 3 * 10 - 3 + 8
 * calculation steps:
 * 1 + 2 = 3
 * 3 / 3 = 1
 * 1 * 10 = 10
 * 10 - 3 = 7
 * 7 + 8 = 15


https://www.codewars.com/kata/57cc3302d954d951530000a5
*/

namespace Kata\Y2026\Q3;

use DigitCountOverflowException;
use DivisionByZeroException;
use InvalidInputException;

class FluentCalculator
{
	private ?int $result = null;
	private array $inputChain;
	const ALLOWEDDIGITS = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "zero"];
	const ALLOWEDOPERATORS = ["plus", "minus", "dividedBy", "times"];

	public function __construct() {
		$this->inputChain = [
			new CalculatorInput("zero"),
			new CalculatorInput("plus"),
		];
	}

	public static function init() : FluentCalculator {
		return new FluentCalculator();
	}

	public function __get(string $name): FluentCalculator {
		var_dump($name);
		//throw new InvalidInputException();
		//throw new DigitCountOverflowException();
		//throw new DivisionByZeroException
	}

	/**
	 * @throws InvalidInputException
	 */
	public function __call(string $name, array $arguments): int {
		$this->checkIfValid($name);
		$input = new CalculatorInput($name);
		$this->addInputToChain($input);
		//if ($this->checkIfMustCalculate()) {
			$this->calculate();
		//}
	}

	/**
	 * @throws InvalidInputException
	 */
	private function checkIfValid(string $name): void {
		if (!in_array($name, self::ALLOWEDDIGITS) && !in_array($name, self::ALLOWEDOPERATORS)) {
			throw new InvalidInputException("$name is not a valid number");
		}
	}

	private function addInputToChain(CalculatorInput $input)
	{
		$lastIndex = array_key_last($this->inputChain);
		$lastInput = $this->inputChain[$lastIndex];
		// Rewrite if last and now is operator
		if ($lastInput->operator === true && $input->operator === true) {
			$this->inputChain[$lastIndex] = $input;
		}else {
			$this->inputChain[] = $input;
		}


	}

	private function checkIfMustCalculate(): bool
	{
		$countOperators = 0;
		foreach ($this->inputChain as $chainEntry) {
			if ($chainEntry->operator === true) {
				$countOperators ++;
			}
		}

		if ($countOperators === 2) {
			return true;
		}
		return false;
	}

	private function calculate(): void
	{
		$saveLastOperator = $this->inputChain[array_key_last($this->inputChain)];
		if ($this->result === null) {
			$numOne = (int)$this->inputChain[0]->name;
			$operator = $this->inputChain[1];
		}else {
			$numOne = $this->result;
			$operator = $this->inputChain[0]->name;
		}

		$operatorIndex = array_search($operator, $this->inputChain, true);

		$numberTwo = '';

		for ($i = $operatorIndex + 1; $i <= count($this->inputChain) - 1; $i++) {
			$numberTwo .= $this->inputChain[$i]->name;
		}
		//TODO here calculate new $result
		var_dump($numOne, $operator, $numberTwo);

	}

}

class CalculatorInput
{
	public string $name;
	public bool $operator = false;

	public function __construct(string $name) {
		$this->name = $name;
		if (in_array($name, FluentCalculator::ALLOWEDOPERATORS)) {
			$this->operator = true;
		}
	}
}