<?php

/*
Write a class that, when given a string, will return an uppercase string with each letter shifted forward in the alphabet by however many spots the cipher was initialized to.

For example:

$c = new CaesarCipher(5);
$c->encode('Codewars'); // returns 'HTIJBFWX'
$c->decode('BFKKQJX'); // returns 'WAFFLES'
If something in the string is not in the alphabet (e.g. punctuation, spaces), simply leave it as is.
The shift will always be in range of [1, 26].

https://www.codewars.com/kata/526d42b6526963598d0004db
*/

declare(strict_types=1);

namespace Kata\Y2026\Q3;

class CaesarCipherHelper
{
    private int $shift;

    private array $alphabet;

    public function __construct(int $shift)
    {
        $this->shift = $shift;
        $this->alphabet = range('A', 'Z');
    }

    public function decode(string $string): string
    {
        return $this->helper($string, '-');
    }

    public function encode(string $string): string
    {
        return $this->helper($string, '+');
    }

    private function helper(string $string, string $operator): string
    {
        $characters = str_split($string);
        $outputText = '';

        foreach ($characters as $character) {
            $charIndex = array_search(strtoupper($character), $this->alphabet);

            if ($charIndex !== false) {
                if ($operator == '+') {
                    $newIndex = (int)$charIndex + $this->shift;
                    if ($newIndex > count($this->alphabet) - 1) {
                        $newIndex -= 26;
                    }
                } else {
                    $newIndex = (int)$charIndex - $this->shift;
                    if ($newIndex < 0) {
                        $newIndex += 26;
                    }
                }
                $outputText .= $this->alphabet[$newIndex];
            } else {
                $outputText .= $character;
            }
        }

        return $outputText;
    }
}
