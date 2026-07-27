<?php


function my_crib(int $n):string {
	$crib = '';
	$base = $n*2 + 2;
	$roofMinus = 0;
	for ($roofFloor = $base; $roofFloor > 0; $roofFloor = $roofFloor - 2) {
		$crib .= str_repeat(' ', floor(($base - 2 - $roofMinus) / 2));
		$crib .= '/';

		if ($roofFloor === 2) {
			$crib .= str_repeat('_', floor(($base - 2 + $roofMinus) / 2));
		}elseif ($roofFloor === $base) {
			$crib .= '';
		}else {
			$crib .= str_repeat(' ', floor(($base - 2 + $roofMinus) / 2));
		}

		$crib .= '\\';
		$crib .= str_repeat(' ', floor(($base - 2 - $roofMinus) / 2));

		$crib .= '\n';
		$roofMinus = $roofMinus + 2;
	}
	for ($floor = $n; $floor > 0; $floor--) {
		$crib .= '|';
		if ($floor === 1) {
			$crib .= str_repeat('_', $n*2);
		}
		$crib .= '|\n';
	}

	return $crib;
}
