<?php

/*
Write a class that, when given a string, will return an uppercase string with each letter shifted forward in the alphabet by however many spots the cipher was initialized to.

For example:

$c = new CaesarCipher(5);
$c->encode('Codewars'); // returns 'HTIJBFWX'
$c->decode('BFKKQJX'); // returns 'WAFFLES'
If something in the string is not in the alphabet (e.g. punctuation, spaces), simply leave it as is.
The shift will always be in range of [1, 26].

*/

declare(strict_types=1);


namespace Kata\Y2026\Q3;
class CaesarCipherHelper
{
	private int $shift;

	private array $alphabet;

	public function __construct(int $shift)
	{
		$this->shift = $shift;
		$this->alphabet = range('A', 'Z');
	}

	public function decode(string $string): string
	{
		$dwa = "dw";
	}

	public function encode(string $string): string
	{
		$characters = str_split($string);
		$cipheredText = '';

		foreach ($characters as $character) {
			$charIndex = array_search(strtoupper($character), $this->alphabet);

			if ($charIndex !== false) {
				$newIndex = $charIndex + $this->shift;
				if ($newIndex > 26) {
					$newIndex -= 26;
				}
				$cipheredText .= $this->alphabet[$newIndex];
			}else {
				$cipheredText .= $character;
			}
		}

		return $cipheredText;
	}
}