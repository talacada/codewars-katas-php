<?php

declare(strict_types=1);

namespace Y2026\Q2;

use function Kata\Y2026\Q2\productFib;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/FibProduct.php';

class FibProductTest extends TestCase
{
    private function revTest($actual, $expected): void
    {
        $this->assertSame($expected, $actual);
    }
    public function testBasics()
    {
        $this->revTest(productFib(714), [21, 34, true]);
        $this->revTest(productFib(4895), [55, 89, true]);
        $this->revTest(productFib(5895), [89, 144, false]);
        $this->revTest(productFib(74049690), [6765, 10946, true]);
    }
}
