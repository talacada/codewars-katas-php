<?php

namespace Kata\Y2026\Q2;


class ZonkGame
{
	private array $rolled = [];
	private int $score = 0;
	const COMBINATIONS = [
		[[1, 2, 3, 4, 5, 6], 1000],
		[['three_pairs'], 750],
		[[1, 1, 1], 1000],
		[[2, 2, 2], 200],
		[[3, 3, 3], 300],
		[[4, 4, 4], 400],
		[[5, 5, 5], 500],
		[[6, 6, 6], 600],
		[['four_of_kind'], 2],
		[['five_of_kind'], 2],
		[['six_of_kind'], 2],
		[[1], 100],
		[[5], 50]
	];

	function __construct(array $dice)
	{
		$this->rolled = $dice;
	}

	public function getScore():string
	{
		$this->score = self::bestCombination();
		return $this->score;
	}

	private function bestCombination():int
	{
		// Nemuzu jit postupne po combinachich. musím porovnat vsechny a vybrat nejlepsi co dava nejvice bodu

		while (true) {
			foreach (self::COMBINATIONS as $combination) {
				if (array_diff($this->rolled, $combination[0])) {
					var_dump($combination);
				}
			}
		}
	}

}