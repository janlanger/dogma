<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\BatchCalc;

use Dogma\Arr;
use Dogma\Math\Alphabet\Baudot;
use Dogma\Math\Alphabet\Ita2;
use Dogma\Math\Alphabet\Morse;
use Dogma\Math\CharCalc;
use Dogma\Math\IntCalc;
use Dogma\Math\RomanCalc;
use Dogma\Math\Sequence\Catalan;
use Dogma\Math\Sequence\Divisors;
use Dogma\Math\Sequence\Fibonacci;
use Dogma\Math\Sequence\Lucas;
use Dogma\Math\Sequence\Prime;
use Dogma\Math\Sequence\Tribonacci;
use Dogma\ShouldNotHappenException;
use Dogma\Str;
use Dogma\StrictBehaviorMixin;
use function abs;
use function array_keys;
use function array_product;
use function array_search;
use function array_sum;
use function base_convert;
use function count;
use function explode;
use function in_array;
use function intval;
use function implode;
use function is_numeric;
use function log;
use function str_split;
use function strrev;

class BatchCalc
{
	use StrictBehaviorMixin;

    private const LETTERS = ['Z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    private const OPERATORS = ['+', '-', '*', '/', '%', '**', '<<', '>>', '&', '|', '^', '&&', '||', 'and', 'or', 'xor', '?:', '??', '.'];

    /** @var callable[] */
    private static $actions;

    /** @var int[][] */
    private static $argumentsDimension;

    /** @var bool[][] */
    private static $argumentsNullable;

    /** @var int[] */
    private static $outputDimension;

	public function __construct()
	{
		self::initActions();
	}

    /**
     * @param string $action
     * @return bool[]
     */
    public function argumentsNullable(string $action): array
    {
        if ($action === Action::SCALAR_INPUT || $action === Action::VECTOR_INPUT || $action === Action::MATRIX_INPUT) {
            return [];
        }
        return self::$argumentsNullable[$action];
    }

	public function calculate(array $actions): array
	{
		$results = [];
		$dimensions = [];

		$current = 'A';
		foreach ($actions as [$action, $parameters]) {
			if ($action === Action::SCALAR_INPUT) {
				$results[$current] = $parameters[0];
				$dimensions[$current] = 0;
				$current++;
				continue;
			} elseif ($action === Action::VECTOR_INPUT) {
			    $input = $parameters[0];
			    if (is_string($input)) {
			        $input = self::split($input, $parameters[1] ?? ',');
                }
				$results[$current] = $input;
				$dimensions[$current] = 1;
				$current++;
				continue;
			} elseif ($action === Action::MATRIX_INPUT) {
                $input = $parameters[0];
                if (is_string($input)) {
                    $input = self::split($input, $parameters[1] ?? '|');
                    foreach ($input as $i => $row) {
                        $input[$i] = self::split($row, $parameters[2] ?? ',');
                    }
                }
                $results[$current] = $input;
                $dimensions[$current] = 2;
                $current++;
                continue;
            }

			$inputDimension = self::$argumentsDimension[$action];
			$inputNullable = self::$argumentsNullable[$action];
			$arguments = [];
			$argumentDimensions = [];
			foreach ($parameters as $parameter) {
			    $str = is_string($parameter);
			    if ($str && preg_match('/^\\$[A-Z]+$/', $parameter)) {
			        // $C (takes result of C)
					$parameter = substr($parameter, 1);
					$arguments[] = $results[$parameter];
					$dimension = $dimensions[$parameter];
					$argumentDimensions[] = $dimension;
                } elseif ($str && preg_match('/^(\\^+)$/', $parameter, $match)) {
			        // ^^ (takes previous to previous result)
                    $parameter = $current;
                    $length = strlen($match[1]);
                    for ($n = 0; $n < $length; $n++) {
                        $parameter = CharCalc::decrement($parameter);
                    }
                    $arguments[] = $results[$parameter];
                    $dimension = $dimensions[$parameter];
                    $argumentDimensions[] = $dimension;
                } else {
			        // takes literal value
                    $arguments[] = $parameter;
                    $argumentDimensions[] = 0;
                }
			}

			[$result, $upscale] = self::call(self::$actions[$action], $inputDimension, $inputNullable, $arguments, $argumentDimensions);
			$results[$current] = $result;
			$dimensions[$current] = self::$outputDimension[$action] + $upscale;

			$current++;
		}

		return $results;
	}

	/**
	 * @param callable $function
	 * @param int[] $inputDimensions
	 * @param bool[] $inputNullable
	 * @param mixed[] $arguments
	 * @param int[] $argumentDimensions
	 * @return mixed (mixed $result, int $upscale)
	 * @internal
	 */
	public static function call(
		callable $function,
		array $inputDimensions,
		array $inputNullable,
		$arguments,
		array $argumentDimensions
	)
	{
		$diffs = [];
		$counts = [];
		foreach ($inputDimensions as $i => $inputDimension) {
			if (!isset($arguments[$i]) && !$inputNullable[$i]) {
				return null;
			}
			$diffs[$i] = $argumentDimensions[$i] - $inputDimensions[$i];
			$counts[$i] = $diffs[$i] > 0 ? count($arguments[$i]) : 0;
		}
		$minDiff = min($diffs);
		if ($minDiff < 0) {
			throw new ShouldNotHappenException('Value dimension should be same or higher than argument dimension.');
		}
		$maxDiff = max($diffs);
		$maxCount = max($counts);

		if ($maxDiff > 0) {
			foreach ($diffs as $i => $diff) {
				if ($diff < $maxDiff) {
					$arguments[$i] = array_fill(0, $maxCount, $arguments[$i]);
				} else {
					$argumentDimensions[$i]--;
				}
			}
			$arguments = Arr::transposeSafe($arguments);
			$results = [];
			foreach ($arguments as $itemArguments) {
				[$result, ] = self::call($function, $inputDimensions, $inputNullable, $itemArguments, $argumentDimensions);
				$results[] = $result;
			}
			return [$results, $maxDiff];
		}

		return [$function(...$arguments), 0];
	}

    private static function initActions(): void
    {
        if (self::$actions !== null) {
            return;
        }

        $actions = [
            // operators
            Action::PLUS        => function ($x, $y) { return $x + $y; },
            Action::MINUS       => function ($x, $y) { return $x - $y; },
            Action::MULTIPLY    => function ($x, $y) { return $x / $y; },
            Action::DIVIDE      => function ($x, $y) { return $x * $y; },
            Action::MODULO      => function ($x, $y) { return intval($x) % intval($y); },
            Action::POWER       => function ($x, $y) { return $x ** $y; },
            Action::ROOT        => function ($x, $y) { return $x ** (1 / $y); },
            Action::LOG         => function ($x, $y) { return log($x, $y); },
            Action::ABS         => function ($x) { return abs($x); },
            Action::INCREMENT   => function ($x) { return ++$x; },
            Action::DECREMENT   => function ($x) { return --$x; },
            Action::LEFT_SHIFT  => function ($x, $y) { return $x << $y; },
            Action::RIGHT_SHIFT => function ($x, $y) { return $x >> $y; },
            Action::BIT_AND     => function ($x, $y) { return $x & $y; },
            Action::BIT_OR      => function ($x, $y) { return $x | $y; },
            Action::BIT_XOR     => function ($x, $y) { return $x ^ $y; },
            Action::BIT_NOT     => function ($x) { return ~$x; },
            Action::OPERATOR    => function ($x, $y, $op) { return self::operator($x, $y, $op); },

            // sequences
            Action::PRIME       => function ($x) { return Prime::getNth($x); },
            Action::PRIME_POS   => function ($x) { return Prime::getPosition($x); },
            Action::LUCAS       => function ($x) { return Lucas::getNth($x); },
            Action::LUCAS_POS   => function ($x) { return Lucas::getPosition($x); },
            Action::FIBONACCI   => function ($x) { return Fibonacci::getNth($x); },
            Action::FIBONACCI_POS => function ($x) { return Fibonacci::getPosition($x); },
            Action::TRIBONACCI  => function ($x) { return Tribonacci::getNth($x); },
            Action::TRIBONACCI_POS => function ($x) { return Tribonacci::getPosition($x); },
            Action::CATALAN     => function ($x) { return Catalan::getNth($x); },
            Action::CATALAN_POS	=> function ($x) { return Catalan::getPosition($x); },
            Action::FACTORIAL   => function ($x) { return IntCalc::factorial($x); },
            Action::DIVISORS    => function ($x) { return Divisors::getNth($x); },

            // logic
            Action::AND         => function ($x, $y) { return $x && $y; },
            Action::OR          => function ($x, $y) { return $x || $y; },
            Action::XOR         => function ($x, $y) { return $x xor $y; },
            Action::NOT         => function ($x) { return !$x; },
            Action::IF_ELSE     => function ($condition, $y, $z) { return $condition ? $y : $z; },
            Action::IF_NOT      => function ($x, $y) { return $x ?: $y; },
            Action::COALESCE    => function ($x, $y) { return $x ?? $y; },

            // arrays
            Action::FACTORIZE   => function ($x) { return $x > 0 ? IntCalc::factorize($x) : [null]; },
            Action::SPLIT       => function ($x, $div) { return self::split($x, $div); },
            Action::JOIN        => function ($x, $div) { return implode($div, $x); },
            Action::FLATTEN     => function ($x) { return array_merge(...$x); },
            Action::FILTER      => function ($x, $cond) { return array_filter($x); },
            Action::UNIQUE      => function ($x) { return array_unique(array_filter($x, function ($x) { return $x !== null; } )); },
            Action::COUNT       => function (array $x, $item) { return $item === null ? count($x) : count(array_keys($x, $item)); },
            Action::SUM         => function (array $x) { return array_sum($x); },
            Action::PRODUCT     => function (array $x) { return array_product($x); },
            Action::REDUCE      => function (array $x, $op) { return self::operatorReduce($x, $op); },

            // strings
            //Action::FILTER    => function ($x, $y) { return str_replace($y, '', $x); },
            Action::CONCAT      => function ($x, $y) { return $x . $y; },
            Action::REVERSE     => function ($x) { return strrev($x); },
            Action::ROTATE_STRING  => function ($x, $pos) { return CharCalc::rotateString($x, $pos); },
            Action::ROTATE_LETTERS => function ($x, $pos) { return CharCalc::rotateLetters($x, $pos); },

            // conversions
            Action::FROM_LETTER => function ($x) { $x = strtoupper($x); return array_search($x, self::LETTERS) ?: null; },
            Action::TO_LETTER   => function ($x) { return self::LETTERS[$x] ?? null; },
            Action::FROM_BASE   => function ($x, $base) { return intval(base_convert($x, $base, 10)); },
            Action::TO_BASE     => function ($x, $base) { return base_convert($x, 10, $base); },
            Action::FROM_BINARY => function ($x) { return intval(base_convert($x, 2, 10)); },
            Action::TO_BINARY   => function ($x) { return base_convert($x, 10, 2); },
            Action::FROM_ROMAN  => function ($x) { return RomanCalc::romanToInt($x); },
            Action::TO_ROMAN    => function ($x) { return RomanCalc::intToRoman($x); },
            Action::FROM_MORSE  => function ($x) { return Morse::decode($x); },
            Action::TO_MORSE    => function ($x) { return Morse::encode($x); },
            Action::FROM_BAUDOT => function ($x) { return Baudot::decode($x); },
            Action::TO_BAUDOT   => function ($x) { return Baudot::encode($x); },
            Action::FROM_ITA2   => function ($x) { return Ita2::decode($x); },
            Action::TO_ITA2     => function ($x) { return Ita2::encode($x); },
        ];

        foreach ($actions as $signature => $implementation) {
            self::addAction($signature, $implementation);
        }
    }

    public static function addAction(string $signature, callable $implementation): void
    {
        $arguments = explode(',', Str::between($signature, '(', ')'));
        $dimensions = $nullable = [];
        foreach ($arguments as $argument) {
            $dimensions[] = Str::substringCount($argument,'[');
            $nullable[] = (bool) strstr($argument, '?');
        }

        self::$actions[$signature] = $implementation;
        self::$argumentsDimension[$signature] = $dimensions;
        self::$argumentsNullable[$signature] = $nullable;
        self::$outputDimension[$signature] = Str::substringCount(Str::fromFirst($signature, ':'), '[');
    }

    /**
     * @param mixed $x
     * @param string|int|null $div
     * @return string[]|int[]|float[]
     */
    private static function split($x, $div): array
    {
        $div = $div ?? ' ';
        $results = is_numeric($div) || $div === null ? str_split($x, $div) : explode($div, $x);

        return self::normalize($results);
    }

    /**
     * @param mixed|mixed[] $value
     * @return mixed|mixed[]
     */
    private static function normalize($value)
    {
        if (is_array($value)) {
            foreach ($value as $i => $val) {
                $value[$i] = self::normalize($val);
            }
            return $value;
        } elseif (ctype_digit($value)) {
            return (int) $value;
        } elseif (is_numeric($value)) {
            return (float) $value;
        } else {
            return $value;
        }
    }

    /**
     * @param mixed $x
     * @param mixed $y
     * @param string $op
     * @return mixed|null
     */
    private static function operator($x ,$y, string $op)
    {
        if (!in_array($op, self::OPERATORS)) {
            return null;
        }
        return eval("return $x $op $y;");
    }

    /**
     * @param mixed[] $x
     * @param string $op
     * @return mixed|null
     */
    private static function operatorReduce(array $x, string $op)
    {
        if (!in_array($op, self::OPERATORS)) {
            return null;
        }
        $initial = array_shift($x);
        return array_reduce($x, function ($x, $y) use ($op) {
            return eval("return $x $op $y;");
        }, $initial);
    }

}