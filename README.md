# Codewars Katas (PHP)

Daily practice on Codewars.

Profile: https://www.codewars.com/users/Rukla

## Setup

```
composer install
```

## Commands

| Command           | What it does                       |
|-------------------|------------------------------------|
| `composer unit`   | Run PHPUnit tests                  |
| `composer cs`     | PHP-CS-Fixer (dry-run)             |
| `composer cs-fix` | PHP-CS-Fixer (apply fixes)         |
| `composer stan`   | PHPStan static analysis            |
| `composer ready`  | Run all checks (cs + stan + unit)  |

## Structure

```
Kata/                  # Kata solutions
  YYYY/Qn/             #   Year / quarter (Q1–Q4)

Tests/                 # PHPUnit tests
  YYYY/Qn/             #   Mirrors Kata/ structure

Support/               # Reference materials — diagrams, screenshots
  YYYY/Qn/
```

## Goal

Work on Kata every day.

## Completed Katas

| #  | Kata                                      | Dificulty | Solution                                                       | Completed  |
|----|-------------------------------------------|-----------|----------------------------------------------------------------|------------|
| 37 | Product of consecutive Fib numbers        | 5 kyu     | [Kata](Kata/Y2026/Q2/FibProduct.php)                           | 28.06.2026 |
| 36 | Rectangle Rotation                        | 4 kyu     | [Kata](Kata/Y2026/Q2/RectangleRotation.php)                    | 27.06.2026 |
| 35 | RoboScript 4                              | 3 kyu     | [Kata](Kata/Y2026/Q2/RoboScript4.php)                          | 24.06.2026 |
| 34 | RoboScript 3                              | 4 kyu     | [Kata](Kata/Y2026/Q2/RoboScript3.php)                          | 21.06.2026 |
| 33 | RoboScript 2                              | 5 kyu     | [Kata](Kata/Y2026/Q2/RoboScript2.php)                          | 17.06.2026 |
| 32 | RoboScript 1                              | 6 kyu     | [Kata](Kata/Y2026/Q2/RoboScript1.php)                          | 10.06.2026 |
| 31 | So Many Permutations!                     | 4 kyu     | [Kata](Kata/Y2026/Q2/SoManyPermutations.php)                   | 09.06.2026 |
| 30 | Smallest Possible Sum                     | 4 kyu     | [Kata](Kata/Y2026/Q2/SmallestPossibleSum.php)                  | 04.06.2026 |
| 29 | The Observed PIN                          | 4 kyu     | [Kata](Kata/Y2026/Q2/TheObservedPin.php)                       | 31.05.2026 |
| 28 | Count IP Addresses                        | 5 kyu     | [Kata](Kata/Y2026/Q2/CountIpAddresses.php)                     | 27.05.2026 |
| 27 | Sudoku Solver                             | 3 kyu     | [Kata](Kata/Y2026/Q2/SudokuSolver.php)                         | 26.05.2026 |
| 26 | Sum of Intervals                          | 4 kyu     | [Kata](Kata/Y2026/Q2/SumOfIntervals.php)                       | 21.05.2026 |
| 25 | Battleship Field Validator                | 3 kyu     | [Kata](Kata/Y2026/Q2/BattleshipFieldValidator.php)             | 18.05.2026 |
| 24 | Strip Comments                            | 4 kyu     | [Kata](Kata/Y2026/Q2/StripComments.php)                        | 15.05.2026 |
| 23 | Next Bigger Number                        | 4 kyu     | [Kata](Kata/Y2026/Q2/NextBiggerNumber.php)                     | 12.05.2026 |
| 22 | Screen Locking Patterns                   | 3 kyu     | [Kata](Kata/Y2026/Q2/ScreenLockingPatterns.php)                | 09.05.2026 |
| 21 | Zonk Game                                 | 5 kyu     | [Kata](Kata/Y2026/Q2/ZonkGame.php)                             | 01.05.2026 |
| 20 | Format Duration                           | 4 kyu     | [Kata](Kata/Y2026/Q2/FormatDuration.php)                       | 26.04.2026 |
| 19 | Car Park Escape                           | 5 kyu     | [Kata](Kata/Y2026/Q2/CarParkEscape.php)                        | 24.04.2026 |
| 18 | Snakes & Ladders                          | 5 kyu     | [Kata](Kata/Y2026/Q2/SnakesLadders.php)                        | 22.04.2026 |
| 17 | Prime Factors                             | 5 kyu     | [Kata](Kata/Y2026/Q2/PrimeFactors.php)                         | 20.04.2026 |
| 16 | Conway's Game of Life - Unlimited Edition | 4 kyu     | [Kata](Kata/Y2026/Q2/ConwaysGameOfLifeUnlimitedEdition.php)    | 17.04.2026 |
| 15 | RGB To Hex Conversion                     | 5 kyu     | [Kata](Kata/Y2026/Q2/RGBToHexConversion.php)                   | 17.04.2026 |
| 14 | Find the unique string                    | 5 kyu     | [Kata](Kata/Y2026/Q2/FindTheUniqueString.php)                  | 16.04.2026 |
| 13 | Can you get the loop ?                    | 5 kyu     | [Kata](Kata/Y2026/Q2/CanYouGetTheLoop.php)                     | 15.04.2026 |
| 12 | Are they the "same"?                      | 6 kyu     | [Kata](Kata/Y2026/Q2/AreTheyTheSame.php)                       | 08.04.2026 |
| 11 | Duplicate Encoder                         | 6 kyu     | [Kata](Kata/Y2026/Q2/DuplicateEncoder.php)                     | 07.04.2026 |
| 10 | Bit Counting                              | 6 kyu     | [Kata](Kata/Y2026/Q2/BitCounting.php)                          | 06.04.2026 |
| 9  | Multiples of 3 or 5                       | 6 kyu     | [Kata](Kata/Y2026/Q2/MultiplesOf3Or5.php)                      | 05.04.2026 |
| 8  | Highest Scoring Word                      | 6 kyu     | [Kata](Kata/Y2026/Q2/HighestScoringWord.php)                   | 04.04.2026 |
| 7  | Is this a triangle?                       | 7 kyu     | [Kata](Kata/Y2026/Q2/IsThisATriangle.php)                      | 03.04.2026 |
| 6  | Weight for weight                         | 5 kyu     | [Kata](Kata/Y2026/Q2/WeightForWeight.php)                      | 02.04.2026 |
| 5  | Create Phone Number                       | 6 kyu     | [Kata](Kata/Y2026/Q2/CreatePhoneNumber.php)                    | 01.04.2026 |
| 4  | Beginner Series #3 Sum of Numbers         | 7 kyu     | [Kata](Kata/Y2026/Q2/BeginnerSeries3SumOfNumbers.php)          | 31.03.2026 |
| 3  | Find The Parity Outlier                   | 6 kyu     | [Kata](Kata/Y2026/Q2/FindTheParityOutlier.php)                 | 30.03.2026 |
| 2  | Decode the Morse code                     | 6 kyu     | [Kata](Kata/Y2026/Q2/DecodeTheMorseCode.php)                   | 29.03.2026 |
| 1  | Who likes it?                             | 6 kyu     | [Kata](Kata/Y2026/Q2/WhoLikesIt.php)                           | 29.03.2026 |

