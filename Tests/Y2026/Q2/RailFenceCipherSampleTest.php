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
}
