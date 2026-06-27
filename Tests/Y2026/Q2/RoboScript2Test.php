<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/RoboScript2.php';
use function Kata\Y2026\Q2\executeRS2;

class RoboScript2Test extends TestCase
{
    public function testDescriptionExamples()
    {
        $this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", executeRS2("FFFFFLFFFFFLFFFFFLFFFFFL"));
        $this->assertSame("*", executeRS2(""));
        $this->assertSame("******", executeRS2("FFFFF"));
        $this->assertSame("******\r\n*    *\r\n*    *\r\n*    *\r\n*    *\r\n******", executeRS2("FFFFFLFFFFFLFFFFFLFFFFFL"));
        $this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", executeRS2("LFFFFFRFFFRFFFRFFFFFFF"));
        $this->assertSame("    ****\r\n    *  *\r\n    *  *\r\n********\r\n    *   \r\n    *   ", executeRS2("LF5RF3RF3RF7"));
    }

    public function testSimpleDebug()
    {
        $this->assertSame("***\r\n*  \r\n*  ", executeRS2("LF2RF2"));
    }

    public function testMultiDigitParsing()
    {
        $this->assertSame("*************", executeRS2("F12"));
    }

    public function testLeftTurnFromDown()
    {
        $this->assertSame("* \r\n**", executeRS2("RFLF"));
    }
}
