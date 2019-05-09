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
use Dogma\Math\Sequence\Prime;
use Dogma\StaticClassMixin;
use function abs;
use function ceil;
use function floor;

class IntCalc
{
    use StaticClassMixin;

	public static function roundTo(int $number, int $multiple): int
	{
		$up = self::roundUpTo($number, $multiple);
		$down = self::roundDownTo($number, $multiple);

		return abs($up - $number) > abs($number - $down) ? $down : $up;
	}

	public static function roundDownTo(int $number, int $multiple): int
	{
		$multiple = abs($multiple);

		return (int) (floor($number / $multiple) * $multiple);
	}

	public static function roundUpTo(int $number, int $multiple): int
	{
		$multiple = abs($multiple);

		return (int) (ceil($number / $multiple) * $multiple);
	}

    /**
     * @param int $n
     * @return int|float
     */
    public static function factorial(int $n)
    {
        return array_product(range(2, $n));
    }

    /**
     * @param int $number
     * @return int[]
     */
    public static function factorize(int $number): array
    {
        Check::range($number, 1);
        if ($number === 1) {
            return [1];
        }

        $possibleFactors = Prime::getUntil($number);

        $factors = [];
        foreach ($possibleFactors as $factor) {
            while (($number % $factor) === 0) {
                $factors[] = $factor;
                $number /= $factor;
            }
        }

        return $factors;
    }

    public static function greatestCommonDivider(int $a, int $b): int
    {
    	$next = $a % $b;

        return $next === 0 ? $b : self::greatestCommonDivider($b, $next);
    }

    public static function leastCommonMultiple(int $a, int $b): int
    {
        return $a * ($b / self::greatestCommonDivider($a, $b));
    }

	public static function binomialCoefficient(int $n, int $k): int
	{
		$result = 1;

		// since C(n, k) = C(n, n-k)
		if ($k > $n - $k) {
			$k = $n - $k;
		}

		// calculate value of [n*(n-1)*---*(n-k+1)] / [k*(k-1)*---*1]
		for ($i = 0; $i < $k; ++$i) {
			$result *= ($n - $i);
			$result /= ($i + 1);
		}

		return $result;
	}

}
