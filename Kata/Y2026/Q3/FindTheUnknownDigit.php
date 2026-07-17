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

    public function __construct(string $formula)
    {
        $this->formula = new Formula();
        $this->formula->populateFromString($formula);
    }

    public function decipher(): int
    {
		$knownDigits = str_split($this->formula->numberOne . $this->formula->numberTwo . $this->formula->result);
		for ($i = 0; $i < 10; $i++) {
			$newData = str_replace("?", (string)$i, [$this->formula->numberOne, $this->formula->numberTwo, $this->formula->result]);
			$mutatedFormula = new Formula();
			$mutatedFormula->populateFromMutatedData($newData, $this->formula->operator);
            if (in_array((string)$i, $knownDigits)) {
                continue;
            }
            if ($mutatedFormula->containsDoubleZero()) {
                continue;
            }
            if ($mutatedFormula->numberStartsWithZero()) {
                continue;
            }
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
    public const OPERANDS = ['-', '+', '*', '='];
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
            $nowOn = 'operator';
        }

        foreach ($formulaChars as $index => $formulaChar) {
            if ($nowOn === 'number') {
                if (is_numeric($formulaChar) || $formulaChar === '?') {
                    if (isset($return[$previousIndex])) {
                        $return[$previousIndex] .= $formulaChar;
                    } else {
                        $return[] = $formulaChar;
                    }
                } elseif (in_array($formulaChar, self::OPERANDS)) {
                    $nowOn = 'operator';
                    if ($formulaChar === '=') {
                        continue;
                    }
                    $previousIndex++;
                    $return[] = $formulaChar;
                }
                $lastWasMinus = false;
            } elseif ($nowOn === 'operator') {
                if (is_numeric($formulaChar) || $formulaChar === '?') {
                    if ($lastWasMinus) {
                        $return[$previousIndex] .= $formulaChar;
                    } else {
                        $return[] = $formulaChar;
                        $previousIndex++;
                    }
                    $nowOn = 'number';
                    $lastWasMinus = false;
                } elseif ($formulaChar === '-' && $lastWasMinus === false) {
                    $return[] = $formulaChar;
                    if ($index != 0) {
                        $previousIndex++;
                    }
                    $lastWasMinus = true;
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
            default => false
        };

		return $computed === (int)$this->result;
    }

    public function containsDoubleZero(): bool
    {
        $startNumOne = substr($this->numberOne, 0, 2);
        $startNumTwo = substr($this->numberTwo, 0, 2);
        $startResult = substr($this->result, 0, 2);
        if ($startNumOne === "00" || $startNumTwo === "00" || $startResult === "00") {
            return true;
        }

        return false;
    }

    public function numberStartsWithZero(): bool
    {
        $startNumOne = substr($this->numberOne, 0, 1);
        $startNumTwo = substr($this->numberTwo, 0, 1);
        $startResult = substr($this->result, 0, 1);

        if ($startNumOne === "-") {
            $startNumOne = substr($this->numberOne, 1, 1);
        }
        if ($startNumTwo === "-") {
            $startNumTwo = substr($this->numberTwo, 1, 1);
        }
        if ($startResult === "-") {
            $startResult = substr($this->result, 1, 1);
        }
        if ($startNumOne === "0" && strlen($this->numberOne) > 1) {
            return true;
        }
        if ($startNumTwo === "0" && strlen($this->numberTwo) > 1) {
            return true;
        }
        if ($startResult === "0" && strlen($this->result) > 1) {
            return true;
        }

        return false;
    }
}
