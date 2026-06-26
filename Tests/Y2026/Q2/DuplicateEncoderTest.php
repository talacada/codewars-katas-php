<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/DuplicateEncoder.php';
use function Kata\Y2026\Q2\duplicate_encode;

class DuplicateEncoderTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('(((', duplicate_encode('din'));
        $this->assertSame('()()()', duplicate_encode('recede'));
        $this->assertSame(')())())', duplicate_encode('Success'));
        $this->assertSame('))((', duplicate_encode('(( @'));
    }
}
