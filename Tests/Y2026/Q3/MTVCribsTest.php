<?php

declare(strict_types=1);

namespace Y2026\Q3;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/MTVCribs.php';

class MTVCribsTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('   /\\   \n  /  \\  \n /    \\ \n/______\\\n|      |\n|      |\n|______|', my_crib(3));
        $this->assertSame('  /\\  \n /  \\ \n/____\\\n|    |\n|____|', my_crib(2));
        $this->assertSame(' /\\ \n/__\\\n|__|', my_crib(1));
    }
}
