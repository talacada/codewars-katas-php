<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\NestingStructureComparison;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/NestingStructureComparison.php';

function same_structure_as(array $main, array $compare): bool
{
    $class = new NestingStructureComparison();
    return $class->output($main, $compare);
}

class NestingStructureComparisonTest extends TestCase
{
    public function testDescriptionExamples(): void
    {
        $this->assertFalse(same_structure_as([[[], []]], [[1, 1]]));
        $this->assertTrue(same_structure_as([1, 1, 1], [2, 2, 2]));
        $this->assertTrue(same_structure_as([1, [1, 1]], [2, [2, 2]]));
        $this->assertFalse(same_structure_as([1, [1, 1]], [[2, 2], 2]));
        $this->assertFalse(same_structure_as([1, [1, 1]], [[2], 2]));
        $this->assertTrue(same_structure_as([[[], []]], [[[], []]]));
    }

    public function testEmptyArrays(): void
    {
        $this->assertTrue(same_structure_as([], []));
    }
    public function testCompareLongerThanMainShouldFail(): void
    {
        // $compare má víc prvků — jiná struktura
        $this->assertFalse(same_structure_as([1, 2], [1, 2, 3]));
    }

    public function testNestedCompareLongerThanMainShouldFail(): void
    {
        // Zanořené pole v $compare je delší
        $this->assertFalse(same_structure_as([1, [2, 3]], [1, [2, 3, 4]]));
    }

    public function testMoreTopLevelElementsInCompareShouldFail(): void
    {
        $this->assertFalse(same_structure_as([[1], [2]], [[1], [2], [3]]));
    }

    public function testDeeplyNestedStructureMatch(): void
    {
        $this->assertTrue(same_structure_as([1, [2, [3]]], [4, [5, [6]]]));
    }

    public function testDeeplyNestedStructureMismatch(): void
    {
        $this->assertFalse(same_structure_as([1, [2, [3]]], [4, [5, 6]]));
    }
}
