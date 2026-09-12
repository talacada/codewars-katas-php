<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\VigenèreCipher;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/VigenèreCipher.php';



class VigenereCipherTest extends TestCase
{
    public function test1(): void
    {
        $abc = 'abcdefghijklmnopqrstuvwxyz';
        $key = 'password';
        $c = new VigenèreCipher($key, $abc);

        $this->assertSame('rovwsoiv', $c->encode('codewars'));
        $this->assertSame('codewars', $c->decode('rovwsoiv'));
        $this->assertSame('laxxhsj', $c->encode('waffles'));
        $this->assertSame('waffles', $c->decode('laxxhsj'));
        $this->assertSame('CODEWARS', $c->encode('CODEWARS'));
        $this->assertSame('CODEWARS', $c->decode('CODEWARS'));
        $this->assertSame("xt'k o vwixl qzswej!", $c->encode("it's a shift cipher!"));
        $this->assertSame("it's a shift cipher!", $c->decode("xt'k o vwixl qzswej!"));
    }

    public function test2(): void
    {
        $abc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $key = 'PASSWORD';
        $c = new VigenèreCipher($key, $abc);

        $this->assertSame('ROVWSOIV', $c->encode('CODEWARS'));
        $this->assertSame('CODEWARS', $c->decode('ROVWSOIV'));
        $this->assertSame('LAXXHSJ', $c->encode('WAFFLES'));
        $this->assertSame('WAFFLES', $c->decode('LAXXHSJ'));
        $this->assertSame('codewars', $c->encode('codewars'));
        $this->assertSame('codewars', $c->decode('codewars'));
    }

    public function test3(): void
    {
        $abc = 'abcdefghijklmnopqrstuvwxyz';
        $key = 'pizza';
        $c = new VigenèreCipher($key, $abc);

        $this->assertSame('rwcwpzr', $c->encode('codewars'));
        $this->assertSame('codewars', $c->decode('rwcwpzr'));
        $this->assertSame('lieelta', $c->encode('waffles'));
        $this->assertSame('waffles', $c->decode('lieelta'));
        $this->assertSame('pa_hf', $c->encode('as_if'));
        $this->assertSame('as_if', $c->decode('pa_hf'));
        $this->assertSame('CODEWARS', $c->encode('CODEWARS'));
        $this->assertSame('CODEWARS', $c->decode('CODEWARS'));
    }

    public function test4(): void
    {
        $abc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $key = 'PIZZA';
        $c = new VigenèreCipher($key, $abc);

        $this->assertSame('RWCWPZR', $c->encode('CODEWARS'));
        $this->assertSame('CODEWARS', $c->decode('RWCWPZR'));
        $this->assertSame('LIEELTA', $c->encode('WAFFLES'));
        $this->assertSame('WAFFLES', $c->decode('LIEELTA'));
        $this->assertSame('PA_HF', $c->encode('AS_IF'));
        $this->assertSame('AS_IF', $c->decode('PA_HF'));
        $this->assertSame('codewars', $c->encode('codewars'));
        $this->assertSame('codewars', $c->decode('codewars'));
    }
}

