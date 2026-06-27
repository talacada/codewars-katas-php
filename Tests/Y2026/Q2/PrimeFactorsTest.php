<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/PrimeFactors.php';
use function Kata\Y2026\Q2\primeFactors;

class PrimeFactorsTest extends TestCase
{
    private function revTest($actual, $expected): void
    {
        $this->assertSame($expected, $actual);
    }

    public function testBasics()
    {
        $this->revTest(primeFactors(7775460), "(2**2)(3**3)(5)(7)(11**2)(17)");
        $this->revTest(primeFactors(7919), "(7919)");
        $this->revTest(primeFactors(17 * 17 * 93 * 677), "(3)(17**2)(31)(677)");
    }
}
