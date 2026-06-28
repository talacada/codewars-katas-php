<?php

declare(strict_types=1);

/*
Complete the solution so that it strips all text that follows any of a set of comment markers passed in. Any whitespace at the end of the line should also be stripped out.

Example:

Given an input string of:

apples, pears # and bananas
grapes
bananas !apples
The output expected would be:

apples, pears
grapes
bananas

https://www.codewars.com/kata/51c8e37cee245da6b40000bd
*/

namespace Kata\Y2026\Q2;

function stripComments(string $str, array $markers): string
{
    $explodedString = explode("\n", $str);
    $arrayWithoutComments = [];

    foreach ($explodedString as $line) {
        $found = false;
        $markerIndex = [];

        foreach ($markers as $marker) {
            $index = strpos($line, $marker);
            if ($index !== false) {
                $markerIndex[] = $index;
            }
        }
        asort($markerIndex);
        $markerIndex = array_values($markerIndex);

        if (isset($markerIndex[0])) {
            $line = substr($line, 0, $markerIndex[0]);
            $line = rtrim($line);
            $arrayWithoutComments[] = $line;
            $found = true;
        }

        if (!$found) {
            $arrayWithoutComments[] = $line;
        }
    }
    return implode("\n", $arrayWithoutComments);
}
