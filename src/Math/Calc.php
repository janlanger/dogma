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
use Dogma\StaticClassMixin;

class Calc
{
    use StaticClassMixin;

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

        $possibleFactors = Sequence::primesUntil($number);

        $factors = [];
        foreach ($possibleFactors as $factor) {
            while (($number % $factor) === 0) {
                $factors[] = $factor;
                $number /= $factor;
            }
        }

        return $factors;
    }

    public static function greatestCommonDivider(int $first, int $second): int
    {
        if (function_exists('gmp_gcd')) {
            return gmp_intval(gmp_gcd($first, $second));
        }

        $firstFactors = self::factorize($first);
        $secondFactors = self::factorize($second);
        $commonFactors = [];
        foreach ($firstFactors as $factor) {
            $i = array_search($factor, $secondFactors);
            if ($i !== false) {
                $commonFactors[] = $factor;
                unset($secondFactors[$i]);
            }
        }

        return count($commonFactors) > 0 ? array_product($commonFactors) : 1;
    }

    public static function leastCommonMultiple(int $first, int $second): int
    {
        $firstFactors = self::factorize($first);
        $secondFactors = self::factorize($second);
        foreach ($firstFactors as $factor) {
            $i = array_search($factor, $secondFactors);
            if ($i !== false) {
                unset($secondFactors[$i]);
            }
        }

        return array_product($firstFactors) * array_product($secondFactors);
    }

    public static function simplify(Fraction $fraction): Fraction
    {
        $gcd = self::greatestCommonDivider($fraction->getNumerator(), $fraction->getDenominator());
        if ($gcd === 1) {
            return $fraction;
        }

        return new Fraction($fraction->getNumerator() / $gcd, $fraction->getDenominator() / $gcd);
    }

}
