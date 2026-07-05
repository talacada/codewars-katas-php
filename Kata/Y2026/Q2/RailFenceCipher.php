<?php

declare(strict_types=1);

/*
Create two functions to encode and then decode a string using the Rail Fence Cipher. This cipher is used to encode a string by placing each character successively in a diagonal along a set of "rails". First start off moving diagonally and down. When you reach the bottom, reverse direction and move diagonally and up until you reach the top rail. Continue until you reach the end of the string. Each "rail" is then read left to right to derive the encoded string.

For example, the string "WEAREDISCOVEREDFLEEATONCE" could be represented in a three rail system as follows:

W       E       C       R       L       T       E
  E   R   D   S   O   E   E   F   E   A   O   C
    A       I       V       D       E       N
The encoded string would be:

WECRLTEERDSOEEFEAOCAIVDEN
Write a function/method that takes 2 arguments, a string and the number of rails, and returns the ENCODED string.

Write a second function/method that takes 2 arguments, an encoded string and the number of rails, and returns the DECODED string.

For both encoding and decoding, assume number of rails >= 2 and that passing an empty string will return an empty string.

Note that the example above excludes the punctuation and spaces just for simplicity. There are, however, tests that include punctuation. Don't filter out punctuation as they are a part of the string.

https://www.codewars.com/kata/58c5577d61aefcf3ff000081
*/

namespace Kata\Y2026\Q2;

use ParseError;

class RailFenceCipherEncoder
{
    private string $stringCode;
    private int $numberRails;

    public function __construct(string $stringCode, int $numberRails)
    {
        $this->stringCode = $stringCode;
        if ($numberRails >= 2) {
            $this->numberRails = $numberRails;
        } else {
            throw new ParseError("Number Rails should be greater than 2");
        }
    }
    public function encode(): string
    {
        $result = [];
		$blockSize = 2 * ($this->numberRails - 1);
        $blocks = str_split($this->stringCode,$blockSize);

        foreach ($blocks as $block) {
            $block = str_split($block);
			for ($i = 0; $i < $blockSize; $i++) {
                if ($i < $this->numberRails) {
					if (isset($block[$i])) {
						$result[$i][] = $block[$i];
					}
                } else {
                    if (isset($block[$i])) {
                        $result[2 * ($this->numberRails - 1) - $i][] = $block[$i];
                    }
                }

            }
        }

        $merge = array_merge(...$result);
        return implode("", $merge);
    }
}

class RailFenceCipherDecoder
{
    private string $stringCode;
    private int $numberRails;
    public function __construct(string $stringCode, int $numberRails)
    {
        $this->stringCode = $stringCode;
        if ($numberRails >= 2) {
            $this->numberRails = $numberRails;
        } else {
            throw new ParseError("Number Rails should be greater than 2");
        }
    }
	/*
    public function decode()
    {
        $blocks = [];
        $rows = [];
        $blocksCount = (int)ceil(strlen($this->stringCode) / ($this->numberRails + 1));
        $middleRow = ($this->numberRails - 1) / 2;
        $missingAll = ($blocksCount * ($this->numberRails + 1)) - strlen($this->stringCode);


        $used = 0;
        for ($blocksRow = 0; $blocksRow < $this->numberRails; $blocksRow++) {
            $missingThisRow = 0;
            if ($missingAll > 1 && $missingAll + $blocksRow === $this->numberRails + 1) {
                $missingThisRow = 1;
            }
            if ($blocksRow !== $middleRow) {
                $rows[$blocksRow] = substr($this->stringCode, $used, $blocksCount);
            } else {
                if ($missingAll >  1) {
                    $missingThisRow += 1;
                }
                $rows[$blocksRow] = substr($this->stringCode, $used, $blocksCount * 2 - $missingThisRow);
            }
            $used += strlen($rows[$blocksRow]);
        }

        $final = '';
        for ($block = 0; $block < $blocksCount; $block++) {
            foreach ($rows as $rowIndex => $row) {
                if ($rowIndex === $middleRow) {
                    if (substr($row, $block * 2, 1) !== '') {
                        $final .= substr($row, $block * 2, 1);
                    }
                } else {
                    if (substr($row, $block) !== '') {
                        $final .= substr($row, $block, 1);
                    }
                }

                if (count($rows) === $rowIndex + 1) {
                    if (substr($rows[$middleRow], $block * 2 + 1, 1) !== '') {
                        $final .= substr($rows[$middleRow], $block * 2 + 1, 1);
                    }
                }
            }
        }

        return $final;
    }
	*/
	public function decode()
	{
		$characters = str_split($this->stringCode, 1);
		$blockSize = 2 * ($this->numberRails - 1);
		$blocksCount = (int)ceil(count($characters) / $blockSize);
		$rows = [];


		for($i = 0; $i < $blocksCount; $i++) {
			for ($j = 0; $j < $blockSize; $j++) {

			}
		}

		return $rows;
	}

}
