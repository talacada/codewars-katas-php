<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/CreatePhoneNumber.php';
use function Kata\Y2026\Q2\createPhoneNumber;

class CreatePhoneNumberTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(
            '(123) 456-7890',
            createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 0])
        );
    }
}
