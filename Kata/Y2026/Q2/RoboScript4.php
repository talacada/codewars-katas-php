<?php

/*
About this Kata Series
This Kata Series is based on a fictional story about a computer scientist and engineer who owns a firm that sells a toy robot called MyRobot which can interpret its own (esoteric) programming language called RoboScript. Naturally, this Kata Series deals with the software side of things (I'm afraid Codewars cannot test your ability to build a physical robot!).

Story
Ever since you released RS2 to the market, there have been much fewer complaints from RoboScript developers about the inefficiency of the language and the popularity of your programming language has continuously soared. It has even gained so much attention that Zachary Mikowski, the CEO of the world-famous Doodle search engine, has contacted you to try out your product! Initially, when you explain the RoboScript (RS2) syntax to him, he looks satisfied, but then he soon finds a major loophole in the efficiency of the RS2 language and brings forth the following program:

(F2LF2R)2FRF4L(F2LF2R)2(FRFL)4(F2LF2R)2
As you can see from the program above, the movement sequence (F2LF2R)2 has to be rewritten every time and no amount of RS2 syntax can simplify it because the movement sequences in between are different each time (FRF4L and (FRFL)4). If only RoboScript had a movement sequence reuse feature that makes writing programs like these less repetitive ...

Task
Define and implement the RS3 specification whose syntax is a superset of RS2 (and RS1) syntax. Your interpreter should be named execute() and accept exactly 1 argument code, the RoboScript code to be executed.

Patterns - The New Feature
To solve the problem outlined in the Story above, you have decided to introduce a new syntax feature to RS3 called the "pattern". The "pattern" as defined in RS3 behaves rather like a primitive version of functions/methods in other programming languages - it allows the programmer to define and name (to a certain extent) a certain sequence of movements which can be easily referenced and reused later instead of rewriting the whole thing.

The basic syntax for defining a pattern is as follows:

p(n)<CODE_HERE>q
Where:

p is a "keyword" that declares the beginning of a pattern definition (much like the function keyword in JavaScript or the def keyword in Python)
(n) is any non-negative integer (without the round brackets) which acts as a unique identifier for the pattern (much like a function/method name)
<CODE_HERE> is any valid RoboScript code (without the angled brackets)
q is a "keyword" that marks the end of a pattern definition (like the end keyword in Ruby)
For example, if I want to define (F2LF2R)2 as a pattern and reuse it later in my code:

p0(F2LF2R)2q
It can also be rewritten as below since (n) only serves as an identifier and its value doesn't matter:

p312(F2LF2R)2q
Like function/method definitions in other languages, merely defining a pattern (or patterns) in RS3 should cause no side effects, so:

execute("p0(F2LF2R)2q");   # => '*'
execute("p312(F2LF2R)2q"); # => '*'
To invoke a pattern (i.e. make the MyRobot move according to the movement sequences defined inside the pattern), a capital P followed by the pattern identifier (n) is used:

P0
(or P312, depending on which example you are using)

So:

execute("p0(F2LF2R)2qP0");     # => "    *\r\n    *\r\n  ***\r\n  *  \r\n***  "
execute("p312(F2LF2R)2qP312"); # => "    *\r\n    *\r\n  ***\r\n  *  \r\n***  "
Additional Rules for parsing RS3
It doesn't matter whether the invocation of the pattern or the pattern definition comes first - pattern definitions should always be parsed first, so:

execute("P0p0(F2LF2R)2q");     # => "    *\r\n    *\r\n  ***\r\n  *  \r\n***  "
execute("P312p312(F2LF2R)2q"); # => "    *\r\n    *\r\n  ***\r\n  *  \r\n***  "
Of course, RoboScript code can occur anywhere before and/or after a pattern definition/invocation, so:

execute("F3P0Lp0(F2LF2R)2qF2"); # => "       *\r\n       *\r\n       *\r\n       *\r\n     ***\r\n     *  \r\n******  "
Much like a function/definition can be invoked multiple times in other languages, a pattern should also be able to be invoked multiple times in RS3. So:

execute("(P0)2p0F2LF2RqP0"); # => "      *\r\n      *\r\n    ***\r\n    *  \r\n  ***  \r\n  *    \r\n***    "
If a pattern is invoked which does not exist, your interpreter should throw/raise an exception (depending on the language you are attempting this Kata in) of any kind. This could be anything and will not be tested, but ideally it should provide a useful message which describes the error in detail.

In PHP this must be an inst

execute("p0(F2LF2R)2qP1");   # throws
execute("P0p312(F2LF2R)2q"); # throws
execute("P312");             # throws
Much like any good programming language will allow you to define an unlimited number of functions/methods, your RS3 interpreter should also allow the user to define a virtually unlimited number of patterns. A pattern definition should be able to invoke other patterns if required. If the same pattern (i.e. both containing the same identifier (n)) is defined more than once, your interpreter should throw/raise an exception (depending on the language you are attempting this Kata in) of any kind.

In PHP this error must again be an instance of ParseError.**

execute("P1P2p1F2Lqp2F2RqP2P1");                      # => "  ***\r\n  * *\r\n*** *"
execute("p1F2Lqp2F2Rqp3P1(P2)2P1q(P3)3");             # => "  *** *** ***\r\n  * * * * * *\r\n*** *** *** *"
execute("p1F2Lqp1(F3LF4R)5qp2F2Rqp3P1(P2)2P1q(P3)3"); # throws exception
Furthermore, your interpreter should be able to detect (potentially) infinite recursion, including mutual recursion. Instead of just getting stuck in an infinite loop and timing out, your interpreter should throw/raise an exception (depending on the language you are attempting this Kata in) of any kind when the "stack" (or just the total number of pattern invocations) exceeds a particular very high (but sensible) threshold, but only if said pattern with infinite recursion is invoked at least once.

In PHP this error must again be an instance of ParseError.**

execute("p1F2RP1F2LqP1");      # throws
execute("p1F2LP2qp2F2RP1qP1"); # throws
execute("p1F2RP1F2Lq");        # does not throw
For the sake of simplicity, you may assume that all programs passed into your interpreter contains valid syntax. Furthermore, nesting pattern definitions is not allowed either (it is considered a syntax error) so your interpreter will not need to account for these.

https://www.codewars.com/kata/594b898169c1d644f900002e


THIS KATA MUST BE COMPLETED IN PHP 7.0
*/


namespace Kata\Y2026\Q2\RoboScript4;

use Exception;
use ParseError;


function execute(string $code): string {
	$roboScriptInterpreter = new CodeInterpreter($code);
	return $roboScriptInterpreter->output();
}

class CodeInterpreter
{
	private string $stringCode;
	private array $patterns = [];
	function __construct(string $code)
	{
		$this->stringCode = $code;

	}
	public function output(): string
	{
		['steps' => $codeSteps, 'patterns' => $this->patterns] = (new StepsDecoupler())->makeSteps($this->stringCode);
		$grid = new Grid();
		$grid->validatePatternsExist($codeSteps, $this->patterns);
		$grid->detectRecursion($this->patterns);
		$grid->execute($codeSteps, $this->patterns);
		return $grid->makeOutputGrid();
	}
}

class StepsDecoupler
{
	const digits = '0123456789';
	public function makeSteps(string $code): array
	{
		$steps = [];
		$patterns = [];
		$splitCode = str_split($code);
		$skipHereCauseCycleOrPattern = -1;

		foreach ($splitCode as $index => $step) {
			if ($index <= $skipHereCauseCycleOrPattern) {
				continue;
			}
			if ($step === 'L' || $step === 'R' || $step === 'F' || $step === 'P') {
				$times = 1;
				if (isset($splitCode[$index + 1]) && is_numeric($splitCode[$index + 1])) {
					$nextNumbers = strspn($code, self::digits, $index + 1);
					$times = (int) substr($code, $index + 1, $nextNumbers);
				}

				if ($step === 'F') {
					$steps[] = new Step($times);
				}elseif ($step === 'P') {
					$steps[] = new Pattern($times);
				} elseif ($step === 'R' || $step === 'L') {
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

				$cycle->setChildren((new StepsDecoupler())->makeSteps($cycleCode)['steps']);

				$steps[] = $cycle;
				$skipHereCauseCycleOrPattern = $nextCloseBracket;
			}elseif ($step === 'p') {
				try {
					$nextNumbers = strspn($code, self::digits, $index + 1);
					$patternName = (int) substr($code, $index + 1, $nextNumbers);
				} catch (Exception $exception) {
					throw new ParseError('ERROR');
				}
				$patternStartIndex = $index + strlen((string)$patternName) + 1;
				$patternEndIndex = strpos($code, "q", $index);

				$patternCode = substr($code, $patternStartIndex, $patternEndIndex - $patternStartIndex);

				if (isset($patterns[$patternName])) {
					throw new ParseError('ERROR');
				}

				//Cant define patterns in patterns
				$patterns[$patternName] = (new StepsDecoupler())->makeSteps($patternCode)['steps'];
				$skipHereCauseCycleOrPattern = $patternEndIndex;
			}
		}
		return ['steps' => $steps, 'patterns' => $patterns];
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
	public function execute(array $steps, array $patternsDefinition): void
	{
		foreach ($steps as $step) {
			if ($step instanceof Step) {
				$this->move($step);
			}elseif ($step instanceof Rotate) {
				$this->rotate($step);
			}elseif ($step instanceof Cycle) {
				for ($i = 0; $i < $step->getTimes(); $i++) {
					$this->execute($step->getChildren(), $patternsDefinition);
				}
			}elseif ($step instanceof Pattern) {
				if (!isset($patternsDefinition[$step->getName()])) {
					throw new ParseError('ERROR');
				}
				$patternCode = $patternsDefinition[$step->getName()];

				$this->execute($patternCode, $patternsDefinition);
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

	public function detectRecursion($patternsDefinition): void
	{
		foreach ($patternsDefinition as $patternName => $pattern) {
			foreach ($pattern as $step) {
				if ($step instanceof Pattern) {
					if ($step->getName() === $patternName) {
						throw new ParseError('ERROR');
					}else {
						$this->detectMultiRecursion($step->getName(), $patternsDefinition, [$patternName]);
					}
				}
			}
		}
	}

	private function detectMultiRecursion(int $nextCheckPattern, array $patternsDefinition, array $usedPatterns): void
	{
		foreach ($patternsDefinition[$nextCheckPattern] as $step) {
			if ($step instanceof Pattern) {
				if (in_array($step->getName(), $usedPatterns)) {
					throw new ParseError('ERROR');
				}else {
					$usedPatterns[] = $step->getName();
					$this->detectMultiRecursion($step->getName(), $patternsDefinition, $usedPatterns);
				}
			}
		}
	}

	public function validatePatternsExist($codeSteps, $patterns): void
	{
		foreach ($codeSteps as $step) {
			if ($step instanceof Pattern) {
				if (!isset($patterns[$step->getName()])) {
					throw new ParseError('ERROR');
				}
			}
			if ($step instanceof Cycle) {
				$this->validatePatternsExist($step->getChildren(), $patterns);
			}
		}
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

class Pattern {
	private int $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function getName(): int
	{
		return $this->name;
	}
}


/*
----------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------
*/
