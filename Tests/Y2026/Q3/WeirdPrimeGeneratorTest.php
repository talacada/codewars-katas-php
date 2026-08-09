<?php

declare(strict_types=1);

namespace Y2026\Q3;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/WeirdPrimeGenerator.php';



class WeirdPrimeGeneratorTest extends TestCase
{
    private function revTest(int $actual, int $expected): void
    {
        $this->assertSame($expected, $actual);
    }
    public function testCountOnesBasics(): void
    {
        $this->revTest(countOnes(10000), 9968);
        $this->revTest(countOnes(100), 90);
        $this->revTest(countOnes(1), 1);
        $this->revTest(countOnes(10), 8);
    }
    public function testMaxPnBasics(): void
    {
        $this->revTest(maxPn(5), 47);
        $this->revTest(maxPn(1), 5);
        $this->revTest(maxPn(7), 101);
    }
    public function testanOverAverageBasics(): void
    {
        $this->revTest(anOverAverage(1), 3);
    }
}
