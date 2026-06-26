<?php

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../../Kata/Y2026/Q2/FindTheUniqueString.php';
use function Kata\Y2026\Q2\find_uniq;

class FindTheUniqueStringTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('BbBb', find_uniq(['Aa', 'aaa', 'aaaaa', 'BbBb', 'Aaaa', 'AaAaAa', 'a']));
        $this->assertSame('foo', find_uniq(['abc', 'acb', 'bac', 'foo', 'bca', 'cab', 'cba']));
    }
}

