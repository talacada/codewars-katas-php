<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\FindTheUnknownDigit;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/FindTheUnknownDigit.php';

function solve_expression(string $expression): int
{
    $runeDecipher = new FindTheUnknownDigit($expression);
    return $runeDecipher->decipher();
}

class FindTheUnknownDigitTest extends TestCase
{
    public function testExamples(): void
    {
        $this->assertSame(8, solve_expression('-?56373--9216=-?47157'));
        $this->assertSame(0, solve_expression('?+?=?'));
        $this->assertSame(0, solve_expression('123?45*?=?'));
        $this->assertSame(0, solve_expression('-5?*-1=5?'));
        $this->assertSame(2, solve_expression('1+1=?'));
        $this->assertSame(6, solve_expression('123*45?=5?088'));
        $this->assertSame(-1, solve_expression('19--45=5?'));
        $this->assertSame(5, solve_expression('??*??=302?'));
        $this->assertSame(2, solve_expression('?*11=??'));
        $this->assertSame(2, solve_expression('??*1=??'));
    }
}
