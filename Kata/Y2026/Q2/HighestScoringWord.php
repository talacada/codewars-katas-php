<?php

declare(strict_types=1);

/*
Given a string of words, you need to find the highest scoring word.

Each letter of a word scores points according to its position in the alphabet: a = 1, b = 2, c = 3 etc.

You need to return the highest scoring word as a string.

If two words score the same, return the word that appears earliest in the original string.

All letters will be lowercase and all inputs will be valid.

https://www.codewars.com/kata/highest-scoring-word
*/

namespace Kata\Y2026\Q2;

function high(string $x): string
{
    $words = explode(" ", $x);
    $i = 0;
    $count = [];
    foreach ($words as $word) {
        $count[$i] = 0;
        foreach (str_split($word) as $letter) {
            $count[$i] += ord($letter) - ord('a') + 1;
        }
        $i++;
    }

    $index = array_keys($count, max($count))[0];
    return $words[$index];
}
