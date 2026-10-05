<?php

declare(strict_types=1);

/*
Given an array of positive or negative integers

 I= [i1,..,in]

you have to produce a sorted array P of the form

[ [p, sum of all ij of I for which p is a prime factor (p positive) of ij] ...]

P will be sorted by increasing order of the prime numbers. The final result has to be given as a string in Java, C#, C, C++ and as an array of arrays in other languages.

Example:
I = [12, 15]; //result = [[2, 12], [3, 27], [5, 15]]
[2, 3, 5] is the list of all prime factors of the elements of I, hence the result.

Notes:

It can happen that a sum is 0 if some numbers are negative!
Example: I = [15, 30, -45] 5 divides 15, 30 and (-45) so 5 appears in the result, the sum of the numbers for which 5 is a factor is 0 so we have [5, 0] in the result amongst others.

In Fortran - as in any other language - the returned string is not permitted to contain any redundant trailing whitespace: you can use dynamically allocated character strings.

https://www.codewars.com/kata/54d496788776e49e6b00052f
*/

namespace Kata\Y2026\Q4\SumByFactors;

/*
Kroky řešení:

1. Najdeš všechny prvočíselné dělitele (kladná prvočísla p), která dělí alespoň jedno číslo ze vstupu:
   - Pro číslo 12: 2 a 3 (12 = 2 * 2 * 3)
   - Pro číslo 15: 3 a 5 (15 = 3 * 5)
   - Unikátní prvočísla ze všech čísel: [2, 3, 5]

2. Tato nalezená prvočísla seřadíš vzestupně:
   - 2 < 3 < 5

3. Pro každé toto prvočíslo p sečteš všechna čísla ze vstupu, která jsou jím dělitelná:
   - Pro 2: dělí pouze 12  -> součet: 12         -> dvojice [2, 12]
   - Pro 3: dělí 12 i 15   -> součet: 12 + 15 = 27 -> dvojice [3, 27]
   - Pro 5: dělí pouze 15  -> součet: 15         -> dvojice [5, 15]

4. Výsledek složíš do pole polí:
   [[2, 12], [3, 27], [5, 15]]
*/
function sumOfDivided(array $input): array
{
    $calculator = new SumByFactors($input);
    return $calculator->calculate();
}
class SumByFactors
{
    private array $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function calculate(): array
    {
        $allPrimes = [];
        foreach ($this->input as $value) {
            $allPrimes[] = $this->getPrimeDivisor($value);
        }
        $allPrimes = array_unique(array_merge(...$allPrimes));
        sort($allPrimes);

        $output = [];
        foreach ($allPrimes as $prime) {
            $output[] = $this->sumAllInputsThatCanBeDivided($prime);
        }

        return $output;
    }

    private function getPrimeDivisor(int $input): array
    {
        $nowOn = $input;
        $primes = [];
        for ($i = 2; !in_array($nowOn, [1, -1]); $i++) {
            if ($nowOn % $i === 0) {
                $nowOn = $nowOn / $i;
                $primes[] = $i;
            }
            $nowOn = $this->divideByPrimes($nowOn, $primes);
        }
        return $primes;
    }

    private function divideByPrimes(int $nowOn, array $primes): int
    {
        $canBeDivided = true;
        do {
            $canBeDivided = false;
            foreach ($primes as $prime) {
                if ($nowOn % $prime === 0) {
                    $nowOn = $nowOn / $prime;
                    $canBeDivided = true;
                }
            }
        } while ($canBeDivided);

        return $nowOn;
    }

    private function sumAllInputsThatCanBeDivided(int $prime): array
    {
        $sum = 0;
        foreach ($this->input as $value) {
            if ($value % $prime === 0) {
                $sum += $value;
            }
        }
        return [$prime, $sum];
    }
}
