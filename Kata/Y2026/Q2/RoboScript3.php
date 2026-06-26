<?php

/*
RoboScript #3 - Implement the RS2 Specification
Disclaimer
The story presented in this Kata Series is purely fictional; any resemblance to actual programming languages, products, organisations or people should be treated as purely coincidental.

About this Kata Series
This Kata Series is based on a fictional story about a computer scientist and engineer who owns a firm that sells a toy robot called MyRobot which can interpret its own (esoteric) programming language called RoboScript. Naturally, this Kata Series deals with the software side of things (I'm afraid Codewars cannot test your ability to build a physical robot!).

Story
Last time, you implemented the RS1 specification which allowed your customers to write more concise scripts for their robots by allowing them to simplify consecutive repeated commands by postfixing a non-negative integer onto the selected command. For example, if your customers wanted to make their robot move 20 steps to the right, instead of typing FFFFFFFFFFFFFFFFFFFF, they could simply type F20 which made their scripts more concise. However, you later realised that this simplification wasn't enough. What if a set of commands/moves were to be repeated? The code would still appear cumbersome. Take the program that makes the robot move in a snake-like manner, for example. The shortened code for it was F4LF4RF4RF4LF4LF4RF4RF4LF4LF4RF4RF4 which still contained a lot of repeated commands.

Task
Your task is to allow your customers to further shorten their scripts and make them even more concise by implementing the newest specification of RoboScript (at the time of writing) that is RS2. RS2 syntax is a superset of RS1 syntax which means that all valid RS1 code from the previous Kata of this Series should still work with your RS2 interpreter. The only main addition in RS2 is that the customer should be able to group certain sets of commands using round brackets. For example, the last example used in the previous Kata in this Series:

LF5RF3RF3RF7
... can be expressed in RS2 as:

LF5(RF3)(RF3R)F7
Or ...

(L(F5(RF3))(((R(F3R)F7))))
Simply put, your interpreter should be able to deal with nested brackets of any level.

And of course, brackets are useless if you cannot use them to repeat a sequence of movements! Similar to how individual commands can be postfixed by a non-negative integer to specify how many times to repeat that command, a sequence of commands grouped by round brackets () should also be repeated n times provided a non-negative integer is postfixed onto the brackets, like such:

(SEQUENCE_OF_COMMANDS)n
... is equivalent to ...

SEQUENCE_OF_COMMANDS...SEQUENCE_OF_COMMANDS (repeatedly executed "n" times)
For example, this RS1 program:

F4LF4RF4RF4LF4LF4RF4RF4LF4LF4RF4RF4
... can be rewritten in RS2 as:

F4L(F4RF4RF4LF4L)2F4RF4RF4
Or:

F4L((F4R)2(F4L)2)2(F4R)2F4
All 4 example tests have been included for you. Good luck :D

https://www.codewars.com/kata/58738d518ec3b4bf95000192
*/

namespace Kata\Y2026\Q2\RoboScript3;


function execute(string $code): string {
	$roboScriptInterpreter = new CodeInterpreter($code);
	return $roboScriptInterpreter->output();
}

class CodeInterpreter
{
	private string $stringCode;
	function __construct(string $code)
	{
		$this->stringCode = $code;

	}
	public function output(): string
	{
		$codeSteps = (new StepsDecoupler())->makeSteps($this->stringCode);
		$grid = new Grid();
		$grid->execute($codeSteps);
		return $grid->makeOutputGrid();
	}
}

class StepsDecoupler
{
	const digits = '0123456789';
	public function makeSteps(string $code): array
	{
		$steps = [];
		$splitCode = str_split($code);
		$skipHereCauseCycle = -1;

		foreach ($splitCode as $index => $step) {
			if ($index <= $skipHereCauseCycle) {
				continue;
			}
			if ($step === 'L' || $step === 'R' || $step === 'F') {
				$times = 1;
				if (isset($splitCode[$index + 1]) && is_numeric($splitCode[$index + 1])) {
					$nextNumbers = strspn($code, self::digits, $index + 1);
					$times = (int) substr($code, $index + 1, $nextNumbers);
				}
				if ($step === 'F') {
					$steps[] = new Step($times);
				}else {
					$rotationSide = ($step === 'R') ? 1 : -1;
					$steps[] = new Rotate($rotationSide, $times);
				}
			}elseif ($step === '(') {
				$cycle = new Cycle();
				$times = 1;
				$nextCloseBracket = $this->findClosingBracket($code, $index);
				if (isset($splitCode[$nextCloseBracket + 1]) && is_numeric($splitCode[$nextCloseBracket + 1])) {
					$nextNumbers = strspn($code, self::digits, $nextCloseBracket + 1);
					$times = (int) substr($code, $nextCloseBracket + 1, $nextNumbers);
				}

				$cycleCode = substr($code, $index + 1, $nextCloseBracket - $index - 1);
				$cycle->setTimes($times);

				$cycle->setChildren((new StepsDecoupler())->makeSteps($cycleCode));

				$steps[] = $cycle;
				$skipHereCauseCycle = $nextCloseBracket;
			}else {
				continue;
			}
		}
		return $steps;
	}

	private function findClosingBracket(string $code, int $index): int
	{
		$found = false;
		$nested = 0;
		do {
			$possibleBracelet = strpos($code, ')', $index + 1);

			$countOpeningBracketsInBetween = substr_count($code, '(', $index + 1, $possibleBracelet - $index - 1);

			if ($nested === 0 && $countOpeningBracketsInBetween === 0) {
				$found = true;
			}

			if ($countOpeningBracketsInBetween > 0) {
				$nested += $countOpeningBracketsInBetween - 1;
				$index = $possibleBracelet;
			}else {
				$nested--;
				$index = $possibleBracelet;
			}

		} while ($found === false);


		return $possibleBracelet;
	}
}

class Grid
{
	const moveMap = [
		0 => [-1, 0],
		1 => [0, 1],
		2 => [1, 0],
		3 => [0, -1],
	];
	public array $position = [0, 0];
	public array $grid = [['*']];
	public int $facing = 1;
	public function execute(array $steps): void
	{
		foreach ($steps as $step) {
			if ($step instanceof Step) {
				$this->move($step);
			}elseif ($step instanceof Rotate) {
				$this->rotate($step);
			}elseif ($step instanceof Cycle) {
				for ($i = 0; $i < $step->getTimes(); $i++) {
					$this->execute($step->getChildren());
				}
			}
		}
	}

	private function move(Step $step): void
	{
		for ($i = 0; $i < $step->getTimes(); $i++) {
			if (!isset($this->grid[$this->position[0] + self::moveMap[$this->facing][0]][$this->position[1] + self::moveMap[$this->facing][1]])) {
				$this->extendGrid();
			}
			$this->grid[$this->position[0] + self::moveMap[$this->facing][0]][$this->position[1] + self::moveMap[$this->facing][1]] = '*';
			$this->position = [$this->position[0] + self::moveMap[$this->facing][0], $this->position[1] + self::moveMap[$this->facing][1]];
		}
	}

	private function rotate(Rotate $rotate):void
	{
		if ($rotate->getRotationSide() === 1) {
			$this->facing = ($this->facing + $rotate->getTimes()) % 4;
		}elseif ($rotate->getRotationSide() === -1) {
			$this->facing = ($this->facing - $rotate->getTimes()) % 4;
			if ($this->facing < 0) {
				$this->facing = abs($this->facing);
				if ($this->facing === 1) {
					$this->facing = 3;
				}elseif ($this->facing === 3) {
					$this->facing = 1;
				}
			}
		}
	}

	private function extendGrid(): void
	{
		if ($this->facing === 0 || $this->facing === 2) {
			$empty = array_fill(0, count($this->grid[0]), ' ');
			if ($this->facing === 0) {
				array_unshift($this->grid, $empty);
				$this->position[0] += 1;
			}else {
				$this->grid[] = $empty;
			}
		}elseif ($this->facing === 1 || $this->facing === 3) {
			foreach ($this->grid as $index => $row) {
				if ($this->facing === 1) {
					$row[] = ' ';
				}else {
					array_unshift($row, ' ');
				}
				$this->grid[$index] = $row;
			}
			if ($this->facing === 3) {
				$this->position[1] += 1;
			}
		}
		$this->grid = array_values($this->grid);
	}

	public function makeOutputGrid(): string
	{
		$returnString = "";
		foreach ($this->grid as $index => $row) {
			$returnString .= implode('', $row);
			if ($index < count($this->grid) - 1) {
				$returnString .= "\r\n";
			}
		}
		return $returnString;
	}
}

class Step
{
	private int $times;
	public function __construct(int $times)
	{
		$this->times = $times;
	}

	public function getTimes(): int
	{
		return $this->times;
	}
}

class Cycle
{
	private array $children;
	private int $times;

	public function setTimes(int $times): void
	{
		$this->times = $times;
	}

	public function setChildren(array $steps): void
	{
		$this->children = $steps;
	}

	public function getChildren(): array
	{
		return $this->children;
	}

	public function getTimes(): int
	{
		return $this->times;
	}
}

class Rotate {
	private int $times;
	private int $rotationSide;

	public function __construct(int $side, int $times)
	{
		$this->rotationSide = $side;
		$this->times = $times;
	}

	public function getTimes(): int
	{
		return $this->times;
	}
	public function getRotationSide(): int
	{
		return $this->rotationSide;
	}
}
