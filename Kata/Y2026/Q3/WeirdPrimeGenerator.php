<?php

/*
Consider the sequence a(1) = 7, a(n) = a(n-1) + gcd(n, a(n-1)) for n >= 2:

	7, 8, 9, 10, 15, 18, 19, 20, 21, 22, 33, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 69, 72, 73....

Let us take the differences between successive elements of the sequence and get a second sequence g: 1, 1, 1, 5, 3, 1, 1, 1, 1, 11, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 23, 3, 1....

For the sake of uniformity of the lengths of sequences we add a 1 at the head of g:

g: 1, 1, 1, 1, 5, 3, 1, 1, 1, 1, 11, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 23, 3, 1...

Removing the 1s gives a third sequence: p: 5, 3, 11, 3, 23, 3... where you can see prime numbers.

Task:
Write the following functions:

(not tested): an(n) with parameter n: returns the first n terms of the series of a(n)
(not tested): gn(n) with parameter n: returns the first n terms of the series of g (not tested)
(tested): countOnes(n) with parameter n: returns the number of 1s in the series gn(n) (don't forget to add a 1 at the head)
(not tested): pn(n) with parameter n: returns an array filled with the first n distinct primes in the same order they are found in the sequence gn(n) defined in (3). That is, pn(n) is p with only the first instance of each prime kept.
(tested): maxPn(n) with parameter n: returns the biggest prime number of the n first terms of the sequence pn(n) defined in (4)
(not tested but interesting result): anOver(n) with parameter n: returns an array of n terms a(i) / i for every i such that gn(i) != 1
(tested): anOverAverage(n) with parameter n: returns as an integer the average of anOver(n) defined in (6) ```
Note:
You can write directly functions 3:, 5: and 7:. There is no need to write functions 1:, 2:, 4: 6: except out of pure curiosity.

https://www.codewars.com/kata/562b384167350ac93b00010c

*/

namespace Y2026\Q3;

/*
Tři testované funkce:

  ┌──────────────────┬────────────────────────────────────────┐
  │      Funkce      │                Co dělá                 │
  ├──────────────────┼────────────────────────────────────────┤
  │ countOnes(n)     │ Spočítej, kolik jedniček je v prvních  │
  │                  │ n členech posloupnosti g               │
  ├──────────────────┼────────────────────────────────────────┤
  │ maxPn(n)         │ Najdi prvních n unikátních prvočísel z │
  │                  │  p a vrať to největší                  │
  ├──────────────────┼────────────────────────────────────────┤
  │                  │ Pro každý index i, kde g(i) ≠ 1,       │
  │ anOverAverage(n) │ spočítej a(i) / i. Z prvních n         │
  │                  │ takových hodnot vrať celočíselný       │
  │                  │ průměr                                 │
  └──────────────────┴────────────────────────────────────────┘

  1. Posloupnost a(n)

  Začínáme s a(1) = 7. Každý další člen se vypočítá jako:

  a(n) = a(n-1) + gcd(n, a(n-1))

  Tedy: vezmi předchozí člen, spočítej největšího společného
  dělitele (gcd) aktuálního indexu n a předchozí hodnoty, a ten
  přičti.

  2. Posloupnost g(n) — rozdíly

  g(n) jsou rozdíly mezi po sobě jdoucími členy a(n). A na
  začátek se ještě uměle přidá jedna 1 navíc.

Takže: g = [1] + [a(2)-a(1), a(3)-a(2), a(4)-a(3), ...]

 3. Posloupnost p — vyhozené jedničky

  Když z g odstraníš všechny 1, zbyde ti p: 5, 3, 11, 3, 23, 3...

  A překvapení: všechna tato zbylá čísla jsou prvočísla!
*/

function countOnes(int $n) {
	$array = [];
	for ($i = 0; $i < $n; $i++) {
		$array[] = ($n - 1) + gcd($n, ($n - 1));
	}
	return $array;
}


function maxPn($n) {
	// your code
}
function anOverAverage($n) {
	// your code
}
function gcd(int $n, int $param)
{
	$bestMatch = 1;
	for ($i = 1; $i <= min($n, $param); $i++) {
		if (
			$n % $i === 0 &&
			$param % $i === 0 &&
			$i > $bestMatch
		) {
			$bestMatch = $i;
		}
	}

	return $bestMatch;
}
