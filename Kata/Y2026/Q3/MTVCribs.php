<?php

// https://www.codewars.com/kata/5834a44e44ff289b5a000075

declare(strict_types=1);

namespace Y2026\Q3\MTVCribs;

function my_crib(int $n): string
{
    $crib = '';
    $roofOuterMargin = $n;
    $roofInnerMargin = 0;
    //Roof
    for ($roofFloor = $n; $roofFloor >= 0; $roofFloor--) {
        $crib .= str_repeat(' ', $roofOuterMargin);
        $crib .= '/';

        if ($roofFloor === 0) {
            $crib .= str_repeat('_', $roofInnerMargin * 2);
        } else {
            $crib .= str_repeat(' ', $roofInnerMargin * 2);
        }

        $crib .= '\\';
        $crib .= str_repeat(' ', $roofOuterMargin);

        $crib .= '\n';

        $roofInnerMargin++;
        $roofOuterMargin--;
    }
    //Body
    for ($floor = $n; $floor > 0; $floor--) {
        $crib .= '|';
        if ($floor === 1) {
            $crib .= str_repeat('_', $n * 2);
        } else {
            $crib .= str_repeat(' ', $n * 2);
        }
        $crib .= '|\n';
    }

    return rtrim($crib, "\\n");
}
