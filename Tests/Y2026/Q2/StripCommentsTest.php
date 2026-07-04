<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/StripComments.php';
use function Kata\Y2026\Q2\stripComments;

class StripCommentsTest extends TestCase
{
    public function testSample(): void
    {
        $this->assertSame(
            "avocados cherries \noranges avocados \n? pears - oranges ' \navocados pears pears \n",
            stripComments("avocados cherries \noranges avocados \n? pears - oranges ' \navocados pears pears \n", [',', '^'])
        );
        $this->assertSame("apples, pears\ngrapes\nbananas", stripComments("apples, pears # and bananas\ngrapes\nbananas !apples", ['#', '!']));
        $this->assertSame("apples, pears\ngrapes\nbananas", stripComments("apples, pears # and bananas\ngrapes\nbananas !#apples", ['#', '!']));
        $this->assertSame("a\nc\nd", stripComments("a #b\nc\nd \$e f g", ['#', '$']));
        $this->assertSame(" a\nc\nd", stripComments(" a #b\nc\nd \$e f g", ['#', '$']));
    }

}
