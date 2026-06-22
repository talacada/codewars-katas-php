<?php

/*
The goal of this exercise is to convert a string to a new string where each character in
the new string is "(" if that character appears only once in the original string, or ")"
if that character appears more than once in the original string. Ignore capitalization
when determining if a character is a duplicate.

Examples:
"din"      =>  "((("
"recede"   =>  "()()()"
"Success"  =>  "())())"
"(( @"     =>  "))(("

https://www.codewars.com/kata/duplicate-encoder
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function duplicate_encode(string $word): string
{
    $return = '';
    $word = strtolower($word);
    foreach (str_split($word) as $letter) {
        switch (substr_count($word, $letter)) {
            case 1:
                $return .= "(";
                break;
            default:
                $return .= ")";
        }
    }
    return $return;
}

class DuplicateEncoder extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('(((', duplicate_encode('din'));
        $this->assertSame('()()()', duplicate_encode('recede'));
        $this->assertSame(')())())', duplicate_encode('Success'));
        $this->assertSame('))((' , duplicate_encode('(( @'));
    }
}
