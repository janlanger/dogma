<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math;

use Dogma\Check;
use Dogma\InvalidArgumentException;
use Dogma\StaticClassMixin;

class RomanCalc
{
    use StaticClassMixin;

    private const NUMBERS = [
		'M' => 1000,
		'CM' => 900,
		'D' => 500,
		'CD' => 400,
		'C' => 100,
		'XC' => 90,
		'L' => 50,
		'XL' => 40,
		'X' => 10,
		'IX' => 9,
		'V' => 5,
		'IV' => 4,
		'I' => 1,
	];

	public static function intToRoman(int $number): string
	{
		Check::range($number, 1, 3999);

		$result = '';
		while ($number > 0) {
			foreach (self::NUMBERS as $roman => $int) {
				if ($number >= $int) {
					$number -= $int;
					$result .= $roman;
					break;
				}
			}
		}

		return $result;
	}

	public static function romanToInt(string $number): int
	{
		$number = strtoupper($number);
		if (!preg_match('/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $number)) {
			throw new InvalidArgumentException(sprintf('%s is not a valid roman number.', $number));
		}

		$result = 0;
		foreach (self::NUMBERS as $roman => $int) {
			while (strpos($number, $roman) === 0) {
				$result += $int;
				$number = substr($number, strlen($roman));
			}
		}

		return $result;
	}

}
