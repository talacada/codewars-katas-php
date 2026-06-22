<?php

/*
There is an array of strings. All strings contain similar letters except one. Try to find it!

find_uniq([ 'Aa', 'aaa', 'aaaaa', 'BbBb', 'Aaaa', 'AaAaAa', 'a' ]); // => 'BbBb'
find_uniq([ 'abc', 'acb', 'bac', 'foo', 'bca', 'cab', 'cba' ]); // => 'foo'

Strings may contain spaces. Spaces are not significant, only non-space symbols matter.
E.g. a string that contains only spaces is like an empty string.

It's guaranteed that the array contains more than 2 strings.

https://www.codewars.com/kata/find-the-unique-string
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function find_uniq(array $a): string
{
    $letters = [];
    foreach ($a as $string) {
        $row = array_unique(str_split(strtolower($string), 1));
        sort($row);
        $letters[] = $row;
    }

    $sortedLett = $letters;
    sort($sortedLett);

    if (count(array_diff($sortedLett[1], $sortedLett[array_key_last($sortedLett)])) > 0) {
        $key = array_keys($letters, $sortedLett[array_key_last($sortedLett)], true)[0];
    } else {
        $key = array_keys($letters, $sortedLett[0], true)[0];
    }
    return $a[$key];
}

class FindTheUniqueString extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('BbBb', find_uniq(['Aa', 'aaa', 'aaaaa', 'BbBb', 'Aaaa', 'AaAaAa', 'a']));
        $this->assertSame('foo', find_uniq(['abc', 'acb', 'bac', 'foo', 'bca', 'cab', 'cba']));
    }
}
