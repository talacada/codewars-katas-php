<?php

declare(strict_types=1);

namespace Y2026\Q4\JustifyText;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q4/JustifyText.php';
use function Kata\Y2026\Q4\JustifyText\justify;

class JustifyTextTest extends TestCase
{
	public function testSimpleExample(): void
	{
		$this->assertSame("This is\nan\nexample\nrow", justify("This is an example row", 7));
	}

	public function testLoremIpsum(): void
	{
		$text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis dolor mauris, at elementum ligula tempor eget. In quis rhoncus nunc, at aliquet orci. Fusce at dolor sit amet felis suscipit tristique. Nam a imperdiet tellus. Nulla eu vestibulum urna. Vivamus tincidunt suscipit enim, nec ultrices nisi volutpat ac. Maecenas sit amet lacinia arcu, non dictum justo. Donec sed quam vel risus faucibus euismod. Suspendisse rhoncus rhoncus felis at fermentum. Donec lorem magna, ultricies a nunc sit amet, blandit fringilla nunc. In vestibulum velit ac felis rhoncus pellentesque. Mauris at tellus enim. Aliquam eleifend tempus dapibus. Pellentesque commodo, nisi sit amet hendrerit fringilla, ante odio porta lacus, ut elementum justo nulla et dolor.";

		$expected = implode("\n", [
			"Lorem  ipsum  dolor  sit amet,",
			"consectetur  adipiscing  elit.",
			"Vestibulum    sagittis   dolor",
			"mauris,  at  elementum  ligula",
			"tempor  eget.  In quis rhoncus",
			"nunc,  at  aliquet orci. Fusce",
			"at   dolor   sit   amet  felis",
			"suscipit   tristique.   Nam  a",
			"imperdiet   tellus.  Nulla  eu",
			"vestibulum    urna.    Vivamus",
			"tincidunt  suscipit  enim, nec",
			"ultrices   nisi  volutpat  ac.",
			"Maecenas   sit   amet  lacinia",
			"arcu,  non dictum justo. Donec",
			"sed  quam  vel  risus faucibus",
			"euismod.  Suspendisse  rhoncus",
			"rhoncus  felis  at  fermentum.",
			"Donec lorem magna, ultricies a",
			"nunc    sit    amet,   blandit",
			"fringilla  nunc. In vestibulum",
			"velit    ac    felis   rhoncus",
			"pellentesque. Mauris at tellus",
			"enim.  Aliquam eleifend tempus",
			"dapibus. Pellentesque commodo,",
			"nisi    sit   amet   hendrerit",
			"fringilla,   ante  odio  porta",
			"lacus,   ut   elementum  justo",
			"nulla et dolor.",
		]);

		$this->assertSame($expected, justify($text, 30));
	}
}
