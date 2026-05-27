<?php

/*
Implement a function that receives two IPv4 addresses, and returns the number of addresses between them (including the first one, excluding the last one).

All inputs will be valid IPv4 addresses in the form of strings. The last address will always be greater than the first one.

Examples
* With input "10.0.0.0", "10.0.0.50"  => return   50
* With input "10.0.0.0", "10.0.1.0"   => return  256
* With input "20.0.0.10", "20.0.1.0"  => return  246

https://www.codewars.com/kata/526989a41034285187000de4
*/
namespace Kata\Y2026\Q2;

use PHPUnit\Framework\TestCase;

function ips_between (string $start, string $end):int
{

	$smaller = array_reverse(explode(".", $start));
	$larger = array_reverse(explode(".", $end));

	$smallerNum = 0;
	$largerNum = 0;

	for ($i = 0; $i < 4; $i++) {
		$smallerNum += $smaller[$i] * 256 ** $i;
		$largerNum += $larger[$i] * 256 ** $i;
	}

	return $largerNum - $smallerNum;

}
class CountIpAddresses extends TestCase
{
	public function testExamples() {
		$this->assertSame(1, ips_between("150.0.0.0", "150.0.0.1"));
		$this->assertSame(50, ips_between("10.0.0.0", "10.0.0.50"));
		$this->assertSame(246, ips_between("20.0.0.10", "20.0.1.0"));
	}

	public function testExtra() {
		$this->assertSame(256, ips_between("10.0.0.0", "10.0.1.0"), "přeskočení přes třetí oktet");
		$this->assertSame(65536, ips_between("0.0.0.0", "0.1.0.0"), "přeskočení přes druhý oktet");
		$this->assertSame(1, ips_between("192.168.0.0", "192.168.0.1"), "rozdíl o 1");
		$this->assertSame(0, ips_between("0.0.0.0", "0.0.0.0"), "stejná adresa");
		$this->assertSame(16777216, ips_between("0.0.0.0", "1.0.0.0"), "přeskočení přes první oktet");
	}
}
