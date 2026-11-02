<?php

namespace Kata\Y2026\Q4\JustifyText;

/*

Your task in this Kata is to emulate text justification in monospace font. You will be given a single-lined text and the expected justification width. The longest word will never be greater than this width.

Here are the rules:

Use spaces to fill in the gaps between words.
Each line should contain as many words as possible.
Use '\n' to separate lines.
Last line should not terminate in '\n'
'\n' is not included in the length of a line.
Gaps between words can't differ by more than one space.
Lines should end with a word not a space.
Large gaps go first, then smaller ones ('Lorem--ipsum--dolor--sit-amet,' (2, 2, 2, 1 spaces)).
Last line should not be justified, use only one space between words.
Lines with one word do not need gaps ('somelongword\n').
Example with width=30:

Lorem  ipsum  dolor  sit amet,
consectetur  adipiscing  elit.
Vestibulum    sagittis   dolor
mauris,  at  elementum  ligula
tempor  eget.  In quis rhoncus
nunc,  at  aliquet orci. Fusce
at   dolor   sit   amet  felis
suscipit   tristique.   Nam  a
imperdiet   tellus.  Nulla  eu
vestibulum    urna.    Vivamus
tincidunt  suscipit  enim, nec
ultrices   nisi  volutpat  ac.
Maecenas   sit   amet  lacinia
arcu,  non dictum justo. Donec
sed  quam  vel  risus faucibus
euismod.  Suspendisse  rhoncus
rhoncus  felis  at  fermentum.
Donec lorem magna, ultricies a
nunc    sit    amet,   blandit
fringilla  nunc. In vestibulum
velit    ac    felis   rhoncus
pellentesque. Mauris at tellus
enim.  Aliquam eleifend tempus
dapibus. Pellentesque commodo,
nisi    sit   amet   hendrerit
fringilla,   ante  odio  porta
lacus,   ut   elementum  justo
nulla et dolor.
Also you can always take a look at how justification works in your text editor or directly in HTML (css: text-align: justify).

Have fun :)

https://www.codewars.com/kata/537e18b6147aa838f600001b

*/

/*
 - Rozsekat na objekty slov
 - Spočítat co se vejde do řádku
 - Postupně z leva přidávat mezery dokud není požadovaný počet dosažen
 */

function justify(string $str, int $len) : string {
	$transformer = new JustifyText($str, $len);
	$transformer->getJustifiedText();
}

class JustifyText
{
	private int $rowlength;
	private array $avalibleWords;
	public function __construct(string $str, int $length) {
		$this->rowlength = $length;
		$this->avalibleWords = $this->splitStringToWords($str);
	}

	private function splitStringToWords(string $str): array
	{
		$split = explode(" ", $str);
		$wordList = [];

		foreach ($split as $word) {
			$wordList[] = new Word($word);
		}

		return $wordList;
	}

	public function getJustifiedText(): string
	{
		$rows = [];
		$row[] = new Row($this->rowlength);

		foreach ($this->avalibleWords as $word) {
			$lastRow = $rows[count($rows) - 1];

			assert($lastRow instanceof Row);

			//TODO pokracovat tady. Jesli se slovo vejde tedy pokud aktualni delka row + mezery je mensi nez slovo + mezera tak se prida jinak se vytvori dalsi row.
			if ($lastRow->getCurrentLength()) {

			}
		}


	}
}

class Word {
	private int $length;
	private string $value;

	public function __construct(string $word) {
		$this->length = strlen($word);
		$this->value = $word;
	}
}

class Row {
	private int $maxlength;
	private int $currentLength;
	private array $words;


	public function __construct($maxlength) {
		$this->maxlength = $maxlength;
	}

	public function getMaxlength(): int
	{
		return $this->maxlength;
	}

	public function setMaxlength(int $maxlength): void
	{
		$this->maxlength = $maxlength;
	}

	public function getCurrentLength(): int
	{
		return $this->currentLength;
	}

	public function setCurrentLength(int $currentLength): void
	{
		$this->currentLength = $currentLength;
	}

	public function getWords(): array
	{
		return $this->words;
	}

	public function setWords(array $words): void
	{
		$this->words = $words;
	}

	public function getWordsCount():int
	{
		return count($this->words);
	}
}