<?php

declare(strict_types=1);

// Codewars-provided symbols.
// This file exists only for static analysis — do not autoload or include in tests.

namespace Kata\Y2026\Q2 {

class Node
{
    public function getNext(): Node
    {
        return $this;
    }
}

}

namespace {

define('MORSE_CODE', ['s', 't', 'u', 'b', 's']);

// Preloaded exceptions for FluentCalculator (Kata\Y2026\Q3)
class InvalidInputException extends Exception {
}
class DigitCountOverflowException extends Exception{
}
class DivisionByZeroException extends Exception{
}

}
