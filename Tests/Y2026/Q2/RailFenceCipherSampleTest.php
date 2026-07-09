<?php

declare(strict_types=1);

namespace Y2026\Q2;

use Kata\Y2026\Q2\RailFenceCipherDecoder;
use Kata\Y2026\Q2\RailFenceCipherEncoder;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/RailFenceCipher.php';

function encodeRailFenceCipher($string, $numberRails): string
{
    $encoder = new RailFenceCipherEncoder($string, $numberRails);
    return $encoder->encode();
}

function decodeRailFenceCipher($string, $numberRails)
{
    $decoder = new RailFenceCipherDecoder($string, $numberRails);
    return $decoder->decode();
}


class RailFenceCipherSampleTest extends TestCase
{
    public function testSample()
    {
        $this->assertSame(encodeRailFenceCipher("Hello, World!", 3), "Hoo!el,Wrdl l");
        $this->assertSame(decodeRailFenceCipher("Hoo!el,Wrdl l", 3), "Hello, World!");

        $this->assertSame(encodeRailFenceCipher("", 3), "");
        $this->assertSame(decodeRailFenceCipher("", 3), "");

        $this->assertSame(encodeRailFenceCipher("WEAREDISCOVEREDFLEEATONCE", 3), "WECRLTEERDSOEEFEAOCAIVDEN");
        $this->assertSame(decodeRailFenceCipher("WECRLTEERDSOEEFEAOCAIVDEN", 3), "WEAREDISCOVEREDFLEEATONCE");
    }

    public function testTwoRails()
    {
        $this->assertSame(encodeRailFenceCipher("Hello, World!", 2), "Hlo ol!el,Wrd");
        $this->assertSame(decodeRailFenceCipher("Hlo ol!el,Wrd", 2), "Hello, World!");
    }

    public function testFourRails()
    {
        $this->assertSame(encodeRailFenceCipher("Hello, World!", 4), "H !e,Wdloollr");
        $this->assertSame(decodeRailFenceCipher("H !e,Wdloollr", 4), "Hello, World!");
    }

    public function testSixRails()
    {
        $this->assertSame(encodeRailFenceCipher("Hello, World!", 6), "Hlerdlo!lWo ,");
        $this->assertSame(decodeRailFenceCipher("Hlerdlo!lWo ,", 6), "Hello, World!");
    }

    /**
     * Simplified version of the failing testRandom case.
     * When rails > string length, each character sits on its own rail
     * and both encode/decode should return the original string unchanged.
     */
    public function testMoreRailsThanStringLength()
    {
        $this->assertSame(encodeRailFenceCipher("abcd", 5), "abcd");
        $this->assertSame(decodeRailFenceCipher("abcd", 5), "abcd");
    }

    /**
     * Medium case: blockSize > string length but rails < string length.
     * 8 chars, 5 rails => blockSize = 8, exactly one block.
     */
    public function testHighRailsMediumString()
    {
        $encoded = encodeRailFenceCipher("abcdefgh", 5);
        $this->assertSame(decodeRailFenceCipher($encoded, 5), "abcdefgh");
    }

    /**
     * Nejjednodušší případ, kde selhává decode:
     * 3 znaky, 3 rails. Poslední blok není kompletní (blockSize=4, chybí 1 znak).
     * Decoder chybně přiřadí rail 1 dva znaky a rail 2 nula znaků.
     */
    public function testSimplestFailingDecode()
    {
        $this->assertSame("abc", decodeRailFenceCipher("abc", 3));
    }
}
