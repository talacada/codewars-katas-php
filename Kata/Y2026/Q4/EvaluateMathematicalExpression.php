<?php

declare(strict_types=1);

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

function calc(string $expression): float
{
    $calculator = new EvaluateMathematicalExpression($expression);
    return $calculator->getResult();
}
class EvaluateMathematicalExpression
{
    private array $stream;

    public function __construct(string $expression)
    {
        $expression = str_replace(' ', '', $expression);
        $splitExpression = str_split($expression);

        $stream = [];
        foreach ($splitExpression as $value) {
            if (in_array($value, ['+', '-', '*', '/'])) {
                if ($value != '-') {
                    $stream[] = new Operator($value);
                } else {
                    $last = array_key_last($stream);
                    if ($last === null) {
                        $last = 0;
                    }
                    if ($stream === [] || $stream[$last] instanceof Operator || $stream[$last] instanceof BracketSolo) {
                        if ($stream === [] || !$stream[$last] instanceof BracketSolo) {
                            $stream[] = new Number($value);
                        } else {
                            if ($stream[$last]->isOpening() === true) {
                                $stream[] = new Number($value);
                            } else {
                                $stream[] = new Operator($value);
                            }
                        }
                    } else {
                        $stream[] = new Operator($value);
                    }
                }
            } elseif (in_array($value, ['(', ')'])) {
                if ($value === ')') {
                    $stream[] = new BracketSolo($value);
                } else {
                    $last = array_key_last($stream);
                    if ($last === null) {
                        $last = 0;
                    }

                    if (isset($stream[$last]) && $stream[$last] instanceof Number && $stream[$last]->getStringValue() === '-') {
                        $operatorToUse = '*';
                        if ($last > 0 && isset($stream[$last - 1]) && $stream[$last - 1] instanceof Operator && $stream[$last - 1]->getOperator() === '/') {
                            $operatorToUse = '/';
                        }
                        $stream[$last] = new Number('-1');
                        $stream[] = new Operator($operatorToUse);
                        $stream[] = new BracketSolo($value);
                    } else {
                        $stream[] = new BracketSolo($value);
                    }
                }
            } else {
                if (end($stream) instanceof Number) {
                    $last = array_key_last($stream);
                    if (isset($stream[$last]) && $stream[$last] instanceof Number) {
                        $stream[$last]->addToValue($value);
                    }
                } else {
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
        $orderedOperations = $this->getCalculationOrder($this->stream);
        if ($orderedOperations instanceof Number) {
            return $orderedOperations->getValue();
        }
        $result = $orderedOperations->calculate();
        return $result->getValue();
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
            } else {
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
                        break;
                    } else {
                        $haveBetweenBracelets--;
                    }
                } else {
                    $haveBetweenBracelets++;
                }
            }
        }

        return $i;
    }

    private function transformBracketSoloToFullBrackets(): void
    {
        $count = count($this->stream);
        for ($index = 0; $index < $count; $index++) {
            if (isset($this->stream[$index]) && $this->stream[$index] instanceof BracketSolo && $this->stream[$index]->isOpening() === true) {

                $braceletLength = $this->stream[$index]->getPairBracketIndex();
                $inside = $this->getInsideBracket(array_slice($this->stream, $index + 1, $braceletLength - 1));

                // Deleting old indexes, were moved inside Bracket
                for ($u = $index; $u <= $index + $braceletLength; $u++) {
                    unset($this->stream[$u]);
                }

                $this->stream[$index] = $inside;
                ksort($this->stream);
                $this->stream = array_values($this->stream);
            }
        }
    }

    private function getInsideBracket(array $inside): Bracket|Number
    {
        for ($index = 0; $index < count($inside); $index++) {
            if ($inside[$index] instanceof BracketSolo && $inside[$index]->isOpening() === true) {
                $start = $index;
                $braceletLength = $inside[$index]->getPairBracketIndex();
                $insideInside = $this->getInsideBracket(array_slice($inside, $start + 1, $braceletLength - 1));

                // Deleting old indexes, were moved inside Bracket
                for ($u = $index; $u <= $index + $braceletLength; $u++) {
                    unset($inside[$u]);
                }

                $inside[$start] = $insideInside;

                ksort($inside);
                $inside = array_values($inside);
            }
        }

        // Only one number inside brackets (-5) -> [Number]
        if (count($inside) === 1) {
            return $inside[0];
        } else {
            $bracket = new Bracket();
            $bracket->setInside($inside);
            return $bracket;
        }
    }

    private function getCalculationOrder(array $stream): CalculationOperation|Number
    {
        foreach ($stream as $bracketIndex => $value) {
            if ($value instanceof Bracket) {
                $stream[$bracketIndex] = $this->getCalculationOrder($value->getInside());
            }
        }

        for ($operatorPriority = 1; $operatorPriority < 3; $operatorPriority++) {
            $havePriorityOneOperators = true;
            while ($havePriorityOneOperators) {
                $stream = array_values($stream);
                $index = false;
                foreach ($stream as $index => $value) {
                    if ($value instanceof Operator) {
                        if ($value->getPriority() === $operatorPriority) {
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
                } else {
                    $havePriorityOneOperators = false;
                }
            }
        }
        return $stream[0];
    }
}

class Number
{
    private string $stringValue;

    public function __construct(string $value)
    {
        $this->stringValue = $value;
    }

    public function getValue(): float
    {
        return floatval($this->stringValue);
    }

    public function getStringValue(): string
    {
        return $this->stringValue;
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

    public function __construct(string $operator)
    {
        $this->operator = $operator;
        if (in_array($operator, ['+', '-'])) {
            $this->priority = 2;
        } else {
            $this->priority = 1;
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


}

class BracketSolo
{
    private bool $opening;
    private ?int $pairBracketIndex = null;

    public function __construct(string $value)
    {
        if ($value === '(') {
            $this->opening = true;
        } else {
            $this->opening = false;
        }
    }

    public function isOpening(): bool
    {
        return $this->opening;
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

    public function getInside(): array
    {
        return $this->inside;
    }

    public function setInside(array $inside): void
    {
        $this->inside = $inside;
    }

}

class CalculationOperation
{
    private CalculationOperation|Number|Bracket|null $valueLeft;
    private Operator $operator;
    private CalculationOperation|Number|Bracket|null $valueRight = null;

    public function __construct(CalculationOperation|Number|Bracket|null $valueLeft = null)
    {
        $this->valueLeft = $valueLeft;
    }

    public function setValueLeft(Number|CalculationOperation|Bracket $valueLeft): void
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

    public function setValueRight(Number|CalculationOperation|Bracket $valueRight): void
    {
        $this->valueRight = $valueRight;
    }

    public function calculate(): Number
    {
        if ($this->valueLeft instanceof Bracket) {
            $this->setValueLeft($this->valueLeft->getInside()[0]->calculate());
        }
        if ($this->valueLeft instanceof CalculationOperation) {
            $this->setValueLeft($this->valueLeft->calculate());
        }

        if ($this->valueRight instanceof Bracket) {
            $this->setValueRight($this->valueRight->getInside()[0]->calculate());
        }
        if ($this->valueRight instanceof CalculationOperation) {
            $this->setValueRight($this->valueRight->calculate());
        }

        if ($this->valueLeft instanceof Number && $this->valueRight instanceof Number) {
            if ($this->operator->getOperator() === '+') {
                return new Number((string)($this->valueLeft->getValue() + $this->valueRight->getValue()));
            } elseif ($this->operator->getOperator() === '-') {
                return new Number((string)($this->valueLeft->getValue() - $this->valueRight->getValue()));
            } elseif ($this->operator->getOperator() === '*') {
                return new Number((string)($this->valueLeft->getValue() * $this->valueRight->getValue()));
            } else {
                return new Number((string)($this->valueLeft->getValue() / $this->valueRight->getValue()));
            }
        }

        return new Number('0');
    }
}
