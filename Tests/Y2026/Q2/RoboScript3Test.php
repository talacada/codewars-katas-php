<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/RoboScript3.php';
use function Kata\Y2026\Q2\RoboScript3\execute;

class RoboScript3Test extends TestCase
{
    public function testMy(): void
    {
        $this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", execute("(F)5(L)1(F)5L(F)5LFFFFFL"));
    }
    public function testRS1Compatibility(): void
    {
        $this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", execute("FFFFFLFFFFFLFFFFFLFFFFFL"));
        $this->assertSame("*", execute(""));
        $this->assertSame("******", execute("FFFFF"));
        $this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", execute("FFFFFLFFFFFLFFFFFLFFFFFL"));
        $this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", execute("LFFFFFRFFFRFFFRFFFFFFF"));
        $this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", execute("LF5RF3RF3RF7"));
    }

    public function testDescriptionExamples()
    {
        $this->assertSame("    *****   *****   *****\r\n    *   *   *   *   *   *\r\n    *   *   *   *   *   *\r\n    *   *   *   *   *   *\r\n*****   *****   *****   *", execute("F4L((F4R)2(F4L)2)2(F4R)2F4"));
        $this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", execute("LF5(RF3)(RF3R)F7"));
        $this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", execute("(L(F5(RF3))(((R(F3R)F7))))"));
        $this->assertSame("    *****   *****   *****\r\n    *   *   *   *   *   *\r\n    *   *   *   *   *   *\r\n    *   *   *   *   *   *\r\n*****   *****   *****   *", execute("F4L(F4RF4RF4LF4L)2F4RF4RF4"));
    }
}
