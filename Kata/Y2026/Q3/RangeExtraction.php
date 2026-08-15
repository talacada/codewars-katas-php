<?php

declare(strict_types=1);
/*
A format for expressing an ordered list of integers is to use a comma separated list of either

individual integers
or a range of integers denoted by the starting integer separated from the end integer in the range by a dash, '-'. The range includes all integers in the interval including both endpoints. It is not considered a range unless it spans at least 3 numbers. For example "12,13,15-17"
Complete the solution so that it takes a list of integers in increasing order and returns a correctly formatted string in the range format.

Example:

solution([-10, -9, -8, -6, -3, -2, -1, 0, 1, 3, 4, 5, 7, 8, 9, 10, 11, 14, 15, 17, 18, 19, 20])
// returns '-10--8,-6,-3-1,3-5,7-11,14,15,17-20'
Courtesy of rosettacode.org

https://www.codewars.com/kata/51ba717bb08c1cd60f00002f/train/php
*/

namespace Kata\Y2026\Q3;

class RangeExtraction
{
    private array $output;
    public function __construct(array $array)
    {
        for ($i = 0; $i < count($array); $i++) {
            $countRange = $i;
            while (isset($array[$countRange + 1]) && (int) $array[$countRange + 1] === (int) $array[$countRange] + 1) {
                $countRange++;
            }

            $length = $countRange - $i + 1;

            if ($length >= 3) {
                $this->output[] = new Range($array[$i], (int) $array[$countRange]);
                $i = $countRange;
            } else {
                $this->output[] = new SingleNumber($array[$i]);
            }
        }
    }

    public function getString(): string
    {
        $output = '';

        foreach ($this->output as $value) {
            $output .= $value->getString() . ',';
        }

        return substr($output, 0, -1);
    }
}

abstract class OutputType
{
    private int $start;

    public function __construct(int $start)
    {
        $this->start = $start;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function setStart(int $start): void
    {
        $this->start = $start;
    }

    abstract public function getString(): string;
}

class SingleNumber extends OutputType
{
    public function getString(): string
    {
        return (string) $this->getStart();
    }
}

class Range extends OutputType
{
    private int $end;
    public function __construct(int $start, int $end)
    {
        parent::__construct($start);
        $this->end = $end;
    }

    public function getString(): string
    {
        return $this->getStart() . '-' . $this->end;
    }
}
