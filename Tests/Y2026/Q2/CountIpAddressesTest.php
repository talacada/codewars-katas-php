<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/CountIpAddresses.php';
use function Kata\Y2026\Q2\ips_between;

class CountIpAddressesTest extends TestCase
{
    public function testExamples()
    {
        $this->assertSame(1, ips_between("150.0.0.0", "150.0.0.1"));
        $this->assertSame(50, ips_between("10.0.0.0", "10.0.0.50"));
        $this->assertSame(246, ips_between("20.0.0.10", "20.0.1.0"));
    }

    public function testExtra()
    {
        $this->assertSame(256, ips_between("10.0.0.0", "10.0.1.0"), "přeskočení přes třetí oktet");
        $this->assertSame(65536, ips_between("0.0.0.0", "0.1.0.0"), "přeskočení přes druhý oktet");
        $this->assertSame(1, ips_between("192.168.0.0", "192.168.0.1"), "rozdíl o 1");
        $this->assertSame(0, ips_between("0.0.0.0", "0.0.0.0"), "stejná adresa");
        $this->assertSame(16777216, ips_between("0.0.0.0", "1.0.0.0"), "přeskočení přes první oktet");
    }
}
