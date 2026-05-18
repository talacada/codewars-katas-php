<?php

/*

Your task in order to complete this Kata is to write a function which formats a duration, given as a number of seconds,
in a human-friendly way.

The function must accept a non-negative integer. If it is zero, it just returns "now". Otherwise, the duration
 is expressed as a combination of years, days, hours, minutes and seconds.

It is much easier to understand with an example:

* For seconds = 62, your function should return
    "1 minute and 2 seconds"
* For seconds = 3662, your function should return
    "1 hour, 1 minute and 2 seconds"
For the purpose of this Kata, a year is 365 days and a day is 24 hours.

Note that spaces are important.

Detailed rules
The resulting expression is made of components like 4 seconds, 1 year, etc. In general, a positive integer and one of
 the valid units of time, separated by a space. The unit of time is used in plural if the integer is greater than 1.

The components are separated by a comma and a space (", "). Except the last component, which is separated by " and ",
 just like it would be written in English.

A more significant units of time will occur before than a least significant one. Therefore, 1 second and 1 year is not
 correct, but 1 year and 1 second is.

Different components have different unit of times. So there is not repeated units like in 5 seconds and 1 second.

A component will not appear at all if its value happens to be zero. Hence, 1 minute and 0 seconds is not valid,
 but it should be just 1 minute.

A unit of time must be used "as much as possible". It means that the function should not return 61 seconds,
 but 1 minute and 1 second instead. Formally, the duration specified by of a component must not be greater than
 any valid more significant unit of time.

https://www.codewars.com/kata/52742f58faf5485cae000b9a
*/

namespace Kata\Y2026\Q2;


class FormatDuration
{
	private int $inputSeconds;
	private int $seconds = 0;
	private int $minutes = 0;
	private int $hours = 0;
	private int $days = 0;
	private int $years = 0;
	private string $stringWithNoSeparators = '';
	private string $returnString = '';
	const int SECONDINSECOND = 1;
	const int SECONDSINMINUTE = 60;
	const int SECONDSINDHOUR = 3600;
	const int SECONDSINDDAY = 86400;
	const int SECONDSINDYEAR = 31536000;

	function __construct(int $seconds)
	{
		$this->inputSeconds = $seconds;
	}

	public function getHumanReadableFormat(): string
	{
		$this->splitSecondsIntoComponents();
		$this->formatComponentsIntoStrings();
		$this->addConnectors();
		return $this->returnString;
	}

	private function splitSecondsIntoComponents(): void
	{
		if ($this->inputSeconds / self::SECONDSINDYEAR >= 1) {
			$this->years = floor($this->inputSeconds / self::SECONDSINDYEAR);
			$this->inputSeconds = $this->inputSeconds - $this->years  * self::SECONDSINDYEAR;
		}
		if ($this->inputSeconds / self::SECONDSINDDAY >= 1) {
			$this->days = floor($this->inputSeconds / self::SECONDSINDDAY);
			$this->inputSeconds = $this->inputSeconds - $this->days * self::SECONDSINDDAY;
		}
		if ($this->inputSeconds / self::SECONDSINDHOUR >= 1) {
			$this->hours = floor($this->inputSeconds / self::SECONDSINDHOUR);
			$this->inputSeconds = $this->inputSeconds - $this->hours * self::SECONDSINDHOUR;
		}
		if ($this->inputSeconds / self::SECONDSINMINUTE >= 1) {
			$this->minutes = floor($this->inputSeconds / self::SECONDSINMINUTE);
			$this->inputSeconds = $this->inputSeconds - $this->minutes * self::SECONDSINMINUTE;
		}
		if ($this->inputSeconds / self::SECONDINSECOND >= 1) {
			$this->seconds = floor($this->inputSeconds / self::SECONDINSECOND);
			$this->inputSeconds = $this->inputSeconds - $this->seconds * self::SECONDINSECOND;
		}

	}

	private function formatComponentsIntoStrings(): void
	{
		if ($this->years > 0) {
			if ($this->years === 1) {
				$this->stringWithNoSeparators .= $this->years . ' year|';
			}else {
				$this->stringWithNoSeparators .= $this->years . ' years|';
			}
		}
		if ($this->days > 0) {
			if ($this->days === 1) {
				$this->stringWithNoSeparators .= $this->days . ' day|';
			}else {
				$this->stringWithNoSeparators .= $this->days . ' days|';
			}
		}
		if ($this->hours > 0) {
			if ($this->hours === 1) {
				$this->stringWithNoSeparators .= $this->hours . ' hour|';
			}else {
				$this->stringWithNoSeparators .= $this->hours . ' hours|';
			}
		}
		if ($this->minutes > 0) {
			if ($this->minutes === 1) {
				$this->stringWithNoSeparators .= $this->minutes . ' minute|';
			}else {
				$this->stringWithNoSeparators .= $this->minutes . ' minutes|';
			}
		}
		if ($this->seconds > 0) {
			if ($this->seconds === 1) {
				$this->stringWithNoSeparators .= $this->seconds . ' second|';
			}else {
				$this->stringWithNoSeparators .= $this->seconds . ' seconds|';
			}
		}
	}

	private function addConnectors(): void
	{
		$components = explode('|', $this->stringWithNoSeparators);
		$count =  count($components) - 1;

		for ($i = 0; $i < $count; $i++) {
			if ($i === $count - 1) {
				continue;
			}elseif ($i === $count - 2) {
				$components[$i] = $components[$i] . ' and ';
			}else {
				$components[$i] = $components[$i] . ', ';
			}
		}

		$this->returnString = str_replace('|', '', implode('|', $components));

		if ($this->stringWithNoSeparators === '') {
			$this->returnString = 'now';
		}
	}
}