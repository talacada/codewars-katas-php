<?php

/*
You probably know the "like" system from Facebook and other pages. People can "like" blog
posts, pictures or other items. We want to create the text that should be displayed next
to such an item.

Implement the function which takes an array containing the names of people that like an item.
It must return the display text as shown in the examples:

[]                                -->  "no one likes this"
["Peter"]                         -->  "Peter likes this"
["Jacob", "Alex"]                 -->  "Jacob and Alex like this"
["Max", "John", "Mark"]           -->  "Max, John and Mark like this"
["Alex", "Jacob", "Mark", "Max"]  -->  "Alex, Jacob and 2 others like this"

Note: For 4 or more names, the number in "and 2 others" simply increases.

https://www.codewars.com/kata/who-likes-it
*/

namespace Kata\Y2026\Q2;
use PHPUnit\Framework\TestCase;

function likes($names)
{
    $defaultSingle = ' likes this';
    $defaultMultiple = ' like this';

    if (count($names) === 0) {
        return 'no one' . $defaultSingle;
    }

    $i = 0;
    $finalPrefix = '';
    foreach ($names as $name) {
        if (count($names) === 1) {
            return $name . $defaultSingle;
        } elseif (count($names) === 2) {
            $finalPrefix .= $name;
            if ($i === 0) {
                $finalPrefix .= ' and ';
            }
        } elseif (count($names) >= 3) {
            $finalPrefix .= $name;
            if ($i === 0) {
                $finalPrefix .= ', ';
            } elseif ($i === 1 && count($names) > 3) {
                $count = count($names) - 2;
                $finalPrefix .= ' and ' . $count . ' others';
                break;
            } elseif (count($names) === 3 && $i < 2) {
                $finalPrefix .= ' and ';
            }
        }
        $i++;
    }

    return $finalPrefix . $defaultMultiple;
}

class WhoLikesIt extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('no one likes this', likes([]));
        $this->assertSame('Peter likes this', likes(['Peter']));
        $this->assertSame('Jacob and Alex like this', likes(['Jacob', 'Alex']));
        $this->assertSame('Max, John and Mark like this', likes(['Max', 'John', 'Mark']));
        $this->assertSame('Alex, Jacob and 2 others like this', likes(['Alex', 'Jacob', 'Mark', 'Max']));
    }
}
