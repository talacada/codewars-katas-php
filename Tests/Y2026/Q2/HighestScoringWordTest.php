<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/HighestScoringWord.php';
use function Kata\Y2026\Q2\high;

class HighestScoringWordTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('taxi', high('man i need a taxi up to ubud'));
        $this->assertSame('volcano', high('what time are we climbing up the volcano'));
    }
}
