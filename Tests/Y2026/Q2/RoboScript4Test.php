<?php

declare(strict_types=1);

namespace Y2026\Q2;

use ParseError;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/RoboScript4.php';
use function Kata\Y2026\Q2\RoboScript4\execute;

class RoboScript4Test extends TestCase
{
    protected function randomize(array $a): array
    {
        for ($i = 0; $i < 2 * count($a); $i++) {
            $v = array_rand($a);
            $w = array_rand($a);
            list($a[$v], $a[$w]) = [$a[$w], $a[$v]];
        }
        return $a;
    }
    public function testRS2Only(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame("    **   **      *\r\n    **   ***     *\r\n  **** *** **  ***\r\n  *  * *    ** *  \r\n***  ***     ***  ", execute('(F2LF2R)2FRF4L(F2LF2R)2(FRFL)4(F2LF2R)2'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }
    public function testPatternDefinitionsOnly(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame('*', execute('p0(F2LF2R)2q'));
            },
            function () {
                $this->assertSame('*', execute('p312(F2LF2R)2q'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }
    public function testDefineAndInvoke(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('p0(F2LF2R)2qP0'));
            },
            function () {
                $this->assertSame("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('p312(F2LF2R)2qP312'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }
    public function testParseOrder(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('P0p0(F2LF2R)2q'));
            },
            function () {
                $this->assertSame("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('P312p312(F2LF2R)2q'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }
    public function testMixedCodeBasic(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame("       *\r\n       *\r\n       *\r\n       *\r\n     ***\r\n     *  \r\n******  ", execute('F3P0Lp0(F2LF2R)2qF2'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }
    public function testMultipleInvocations(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame("      *\r\n      *\r\n    ***\r\n    *  \r\n  ***  \r\n  *    \r\n***    ", execute('(P0)2p0F2LF2RqP0'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }

    public function testInvalidInvocation1(): void
    {
        $this->expectException(ParseError::class);
        execute('p0(F2LF2R)2qP1');
    }

    public function testInvalidInvocation2(): void
    {
        $this->expectException(ParseError::class);
        execute('P0p312(F2LF2R)2q');
    }

    public function testInvalidInvocation3(): void
    {
        $this->expectException(ParseError::class);
        execute('P312');
    }
    public function testMultiplePatternDefinitions(): void
    {
        foreach ($this->randomize([
            function () {
                $this->assertSame("  ***\r\n  * *\r\n*** *", execute('P1P2p1F2Lqp2F2RqP2P1'));
            },
            function () {
                $this->assertSame("  *** *** ***\r\n  * * * * * *\r\n*** *** *** *", execute('p1F2Lqp2F2Rqp3P1(P2)2P1q(P3)3'));
            }
        ]) as $assertion) {
            $assertion();
        }
    }

    public function testInvalidDefinitionOverwrite(): void
    {
        $this->expectException(ParseError::class);
        execute('p1F2Lqp1(F3LF4R)5qp2F2Rqp3P1(P2)2P1q(P3)3');
    }

    public function testInfiniteRecursion(): void
    {
        $this->expectException(ParseError::class);
        execute('p1F2RP1F2LqP1');
    }

    public function testInfiniteMutualRecursion(): void
    {
        $this->expectException(ParseError::class);
        execute('p1F2LP2qp2F2RP1qP1');
    }

    public function testMultipleRecursionMinimal(): void
    {
        $this->expectException(ParseError::class);
        execute('p1F3R2F6L3FFFRq(P1)1024P11');
    }
}
