<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/ConwaysGameOfLifeUnlimitedEdition.php';
use function Kata\Y2026\Q2\get_generation;

class ConwaysGameOfLifeUnlimitedEditionTest extends TestCase
{
    public function testExample(): void
    {
        $this->assertSame([
            [0, 1, 0],
            [0, 0, 1],
            [1, 1, 1]
        ], get_generation([
            [1, 0, 0],
            [0, 1, 1],
            [1, 1, 0]
        ], 1));
    }

    public function test2(): void
    {
        $this->assertSame([
            [1, 0, 1],
            [0, 1, 1],
            [0, 1, 0]
        ], get_generation([
            [1, 0, 0],
            [0, 1, 1],
            [1, 1, 0]
        ], 2));
    }

    public function testEmpty(): void
    {
        $this->assertSame([
            []
        ], get_generation([
            [0, 0, 0],
            [0, 0, 0],
            [0, 0, 0]
        ], 1));
    }
}
