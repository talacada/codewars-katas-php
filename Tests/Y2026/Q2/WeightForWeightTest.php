<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/WeightForWeight.php';
use function Kata\Y2026\Q2\orderWeight;

class WeightForWeightTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(
            "100 180 90 56 65 74 68 86 99",
            orderWeight("56 65 74 100 99 68 86 180 90")
        );
    }
}
