<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/MultiplesOf3Or5.php';
use function Kata\Y2026\Q2\solutionMultiples;

class MultiplesOf3Or5Test extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(23, solutionMultiples(10));
        $this->assertSame(0, solutionMultiples(0));
        $this->assertSame(0, solutionMultiples(-5));
    }
}
