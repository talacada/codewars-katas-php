<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/WhoLikesIt.php';
use function Kata\Y2026\Q2\likes;

class WhoLikesItTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame('no one likes this', likes([]));
        $this->assertSame('Peter likes this', likes(['Peter']));
        $this->assertSame('Jacob and Alex like this', likes(['Jacob', 'Alex']));
        $this->assertSame('Max, John and Mark like this', likes(['Max', 'John', 'Mark']));
        $this->assertSame('Alex, Jacob and 2 others like this', likes(['Alex', 'Jacob', 'Mark', 'Max']));
    }
}
