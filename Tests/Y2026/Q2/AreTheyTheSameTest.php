<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/AreTheyTheSame.php';
use function Kata\Y2026\Q2\comp;

class AreTheyTheSameTest extends TestCase
{
    public function testBasics(): void
    {
        $a1 = [121, 144, 19, 161, 19, 144, 19, 11];
        $a2 = [11 * 11, 121 * 121, 144 * 144, 19 * 19, 161 * 161, 19 * 19, 144 * 144, 19 * 19];
        $this->assertTrue(comp($a1, $a2));
    }

    public function testNull(): void
    {
        $this->assertFalse(comp(null, [1, 2, 3]));
        $this->assertFalse(comp([1, 2, 3], null));
    }
}
