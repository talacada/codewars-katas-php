<?php

declare(strict_types=1);

/*
In this kata you have to write a simple Morse code decoder. While the Morse code is now
mostly superseded by voice and digital data communication channels, it still has its use
in some applications around the world.

The Morse code encodes every character as a sequence of "dots" and "dashes". For example,
the letter A is coded as ·−, letter Q is coded as −−·−, and digit 1 is coded as ·−−−−.
The Morse code is case-insensitive, traditionally capital letters are used. When the
message is written in Morse code, a single space is used to separate the character codes
and 3 spaces are used to separate words.

For example, the message HEY JUDE in Morse code is ···· · −·−−   ·−−− ··− −·· ·.

NOTE: Extra spaces before or after the code have no meaning and should be ignored.

In addition to letters, digits and some punctuation, there are some special service codes,
the most notorious of those is the international distress signal SOS (that was first issued
by Titanic), that is coded as ···−−−···. These special codes are treated as single special
characters, and usually are transmitted as separate words.

Your task is to implement a function that would take the morse code as input and return
a decoded human-readable string.

Example:
decode_morse('.... . -.--   .--- ..- -.. .') // => "HEY JUDE"

The Morse code table is preloaded for you as a constant MORSE_CODE.

https://www.codewars.com/kata/decode-the-morse-code
*/

namespace Kata\Y2026\Q2;

function remove_whitespace_elements(string $value): bool
{
    return !preg_match('/^\s*$/', $value);
}

function decode_morse(string $code): string
{
    $words = explode('   ', $code);
    $words = array_filter($words, remove_whitespace_elements(...));
    $letters = [];
    $final = '';

    foreach ($words as $word) {
        array_push($letters, explode(' ', $word));
    }

    $i = 0;
    foreach ($letters as $word) {
        foreach ($word as $letter) {
            if ($letter != "") {
                $final .= MORSE_CODE[$letter];
            }
        }

        if ($i < count($words) - 1) {
            $final .= ' ';
        }

        $i++;
    }

    return $final;
}
