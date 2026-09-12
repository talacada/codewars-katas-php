<?php

/*

In this kata, you will implement cipher functions using utf-8 strings.

The Vigenère cipher is a classic cipher originally developed by Italian cryptographer Giovan Battista Bellaso and published in 1553. It is named after a later French cryptographer Blaise de Vigenère, who had developed a stronger autokey cipher (a cipher that incorporates the message of the text into the key). The cipher is easy to understand and implement, but survived three centuries of attempts to break it, earning it the nickname "le chiffre indéchiffrable" ("the unbreakable cipher")

The Vigenère cipher is a method of encrypting alphabetic text by using a series of different Caesar ciphers based on the letters of a keyword. It is a simple form of polyalphabetic substitution.

In a Caesar cipher, each letter of the alphabet is shifted along some number of places; for example, in a Caesar cipher of shift 3, A would become D, B would become E, Y would become B and so on. The Vigenère cipher consists of several Caesar ciphers in sequence with different shift values.

Assume the key is repeated for the length of the text, character by character. The key advances for every character in the message, regardless of whether that character belongs to the alphabet. Characters not in the alphabet are not encrypted, but they still consume one character of the key. This is different than some other implementations of the Vigenère Cipher.

The shift is derived by applying a Caesar shift to a character with the corresponding index of the key in the alphabet.

Visual representation:

"abcdefghijklmnopqrstuvwxyz"       // alphabet
"my secret code i want to secure"  // message
"passwordpasswordpasswordpasswor"  // key

// The space between "my" and "secret" consumes the
// first "s" of the key, even though the space character
// is not in the alphabet and will not be encrypted.
Write a class that, when given a key and an alphabet, can be used to encode and decode from the cipher.

Examples
alphabet = "abcdefghijklmnopqrstuvwxyz"
key      = "password"

"codewars" --> encode -->  "rovwsoiv"
"laxxhsj"  --> decode -->  "waffles"
Note: any character not in the alphabet must be left alone. For example in the above case:

"CODEWARS"  --> encode -->  "CODEWARS"

https://www.codewars.com/kata/52d1bd3694d26f8d6e0000d3

*/

namespace Kata\Y2026\Q3;

class VigenèreCipher {

	private string $alphabet;
	private array $key;

	public function __construct(string $key, string $alphabet) {
		foreach (str_split($key) as $letter) {
			if (str_contains($alphabet, $letter)) {
				$this->key[] = strpos($alphabet, $letter);
			} else {
				$this->key[] = null;
			}
		}

		$this->alphabet = $alphabet;
	}

	public function encode(string $message):string {
		/*foreach (str_split($message) as $letter) {
			if (str_contains($this->alphabet, $letter)) {
				$cesarShift = ord($letter) - 96;
				$keyShift = $this->key[$keyIndex];

				if ($cesarShift + $keyShift > 26) {
					$newShift = $cesarShift + $keyShift - 26;
				}else {
					$newShift = $keyShift + $cesarShift;
				}

				$encoded .= chr($newShift + 95);
			} else {
				$encoded .= $letter;
			}

			if ($keyIndex <= count($this->key) - 1) {
				$keyIndex++;
			}else {
				$keyIndex = 0;
			}
		}*/

		return $this->transform($message, 'encode');
	}

	public function decode(string $message): string {
		/*$keyIndex = 0;
		foreach (str_split($message) as $letter) {
			if (str_contains($this->alphabet, $letter)) {
				$cesarShift = ord($letter) - 96;
				$keyShift = $this->key[$keyIndex];

				if ($cesarShift - $keyShift < 0) {
					$newShift = $cesarShift - $keyShift + 26;
				}else {
					$newShift = $cesarShift - $keyShift;
				}

				$decoded .= chr($newShift + 97);
			} else {
				$decoded .= $letter;
			}

			if ($keyIndex <= count($this->key) - 1) {
				$keyIndex++;
			}else {
				$keyIndex = 0;
			}
		}*/

		return $this->transform($message, 'decode');
	}

	private function transform(string $message, string $mode): string
	{
		$transformed = '';
		$keyIndex = 0;
		foreach (str_split($message) as $letter) {
			if (str_contains($this->alphabet, $letter)) {
				$cesarShift = strpos($this->alphabet, $letter);
				$keyShift = $this->key[$keyIndex];

				//TODO two modes
				if ($cesarShift - $keyShift < 0) {
					$newShift = $cesarShift - $keyShift + 26;
				}else {
					$newShift = $cesarShift - $keyShift;
				}

				$transformed .= chr($newShift + 97);
			} else {
				$transformed .= $letter;
			}

			if ($keyIndex <= count($this->key) - 1) {
				$keyIndex++;
			}else {
				$keyIndex = 0;
			}
		}

		return $transformed;
	}
}