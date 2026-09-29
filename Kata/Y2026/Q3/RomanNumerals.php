<?php

declare(strict_types=1);

/*
Write two functions that convert a roman numeral to and from an integer value. Multiple roman numeral values will be tested for each function.

Modern Roman numerals are written by expressing each digit separately starting with the left most digit and skipping any digit with a value of zero. In Roman numerals:

1990 is rendered: 1000=M, 900=CM, 90=XC; resulting in MCMXC
2008 is written as 2000=MM, 8=VIII; or MMVIII
1666 uses each Roman symbol in descending order: MDCLXVI.
Input range : 1 <= n < 4000

In this kata 4 should be represented as IV, NOT as IIII (the "watchmaker's four").

Examples
to roman:
2000 -> "MM"
1666 -> "MDCLXVI"
  86 -> "LXXXVI"
   1 -> "I"

from roman:
"MM"      -> 2000
"MDCLXVI" -> 1666
"LXXXVI"  ->   86
"I"       ->    1
Help
+--------+-------+
| Symbol | Value |
+--------+-------+
|    M   |  1000 |
|   CM   |   900 |
|    D   |   500 |
|   CD   |   400 |
|    C   |   100 |
|   XC   |    90 |
|    L   |    50 |
|   XL   |    40 |
|    X   |    10 |
|   IX   |     9 |
|    V   |     5 |
|   IV   |     4 |
|    I   |     1 |
+--------+-------+

https://www.codewars.com/kata/51b66044bce5799a7f000003
*/

namespace Kata\Y2026\Q3;

class RomanNumerals
{
    public const BREAKPOINTS = [
        1 => 'I',
        4 => 'IV',
        5 => 'V',
        9 => 'IX',
        10 => 'X',
        40 => 'XL',
        50 => 'L',
        90 => 'XC',
        100 => 'C',
        400 => 'CD',
        500 => 'D',
        900 => 'CM',
        1000 => 'M'
    ];
    public const JUMPS = [
        1 => '',
        10 => '0',
        100 => '00',
        1000 => '000'
    ];
    public static function toRoman(int $num): string
    {
        $digits = str_split((string) $num);
        $nowOn = count($digits);
        $roman = '';

        foreach ($digits as $digit) {
            $nowOn--;
            $now = (int) ($digit . str_repeat("0", $nowOn));
            if ($now === 0) {
                continue;
            }
            $closestBreakpoint = self::getClosestIndex($now);
            $roman .= self::BREAKPOINTS[$closestBreakpoint];
            if ($closestBreakpoint < $now) {
                $need = $now - $closestBreakpoint;
                $jumpKey = array_search(substr((string)$need, 1), self::JUMPS, true);
                assert($jumpKey !== false);
                $needJump = self::BREAKPOINTS[$jumpKey];

                $roman .= str_repeat($needJump, (int)substr((string)$need, 0, 1));
            }
        }

        return $roman;
    }

    public static function fromRoman(string $str): int
    {
        $num = 0;
        $originalRoman = str_split($str);
        for ($i = 0; $i < count($originalRoman); $i = $i) {
            $char = $str[$i];
            $roman = $char;
            for ($j = $i + 1; $j < count($originalRoman); $j++) {
                if ($char === $originalRoman[$j]) {
                    $roman .= $originalRoman[$j];
                } else {
                    if (array_search($originalRoman[$i], self::BREAKPOINTS, true) < array_search($originalRoman[$j], self::BREAKPOINTS, true)) {
                        $char .= $originalRoman[$j];
                        $roman .= $originalRoman[$j];
                    }
                    break;
                }
            }
            $romanLength = strlen($roman);
            if (count(array_unique(str_split($char))) === 1) {
                $num += array_search($char, self::BREAKPOINTS, true) * $romanLength;
            } else {
                $num += array_search($char, self::BREAKPOINTS, true);
            }

            $i = $i + $romanLength;
        }
        return $num;
    }

    private static function getClosestIndex(int $param): int
    {
        $prev = 1;
        foreach (self::BREAKPOINTS as $index => $breakpoint) {
            if ($param === $index) {
                return $index;
            } elseif ($param < $index) {
                return $prev;
            }
            $prev = $index;
        }

        return 1000;
    }
}
