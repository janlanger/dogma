<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\BatchCalc;

use Dogma\Enum\StringEnum;
use Dogma\Math\IntCalc;
use Dogma\Math\RomanCalc;
use Dogma\Math\Sequence\Catalan;
use Dogma\Math\Sequence\Divisors;
use Dogma\Math\Sequence\Fibonacci;
use Dogma\Math\Sequence\Lucas;
use Dogma\Math\Sequence\Prime;
use Dogma\Math\Sequence\Tribonacci;
use Dogma\Str;
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
use function strlen;
use function strpos;
use function strrev;
use function substr;

class Action extends StringEnum
{

    private const LETTERS = [1 => 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    private const OPERATORS = ['+', '-', '*', '/', '%', '**', '//', '<<', '>>', '&', '|', '¦', '&&', '||', '¦¦', '?:', '??', '.'];

    // n = number, s = string, b = bool, a = any

	// input
	public const INPUT_SCALAR = 'scalarInput(): any';
	public const INPUT_VECTOR = 'vectorInput(): any[]';
	public const INPUT_MATRIX = 'matrixInput(): any[][]';

    // operators
    public const PLUS = 'plus(n, n): n';
    public const MINUS = 'minus(n, n): n';
    public const MULTIPLY = 'multiply(n, n): n';
    public const DIVIDE = 'divide(n, n): n';
    public const MODULO = 'modulo(n, n): n';
    public const MODULO_TOP = 'moduloTop(n, n): n';
    public const POWER = 'power(n, n): n';
    public const ROOT = 'root(n, n): n';
    public const LOG = 'log(n, n): n';
    public const ABS = 'abs(n): n';
	public const INCREMENT = 'increment(n): n';
	public const DECREMENT = 'decrement(n): n';
    public const LEFT_SHIFT = 'leftShift(n, n): n';
    public const RIGHT_SHIFT = 'rightShift(n, n)';
    public const BIT_AND = 'bitAnd(n, n): n';
    public const BIT_OR = 'bitOr(n, n): n';
    public const BIT_XOR = 'bitXor(n, n): n';
    public const BIT_NOT = 'bitNot(n): n';
    public const OPERATOR = 'operator(n, op, n): n';

    // sequences
	public const POWER_OF_TWO = 'powerOfTwo(n): n';
    public const PRIME = 'prime(n): n';
    public const PRIME_POS = 'primePos(n): ?n';
    public const LUCAS = 'lucas(n): n';
    public const LUCAS_POS = 'lucasPos(n): ?n';
    public const FIBONACCI = 'fibonacci(n): n';
    public const FIBONACCI_POS = 'fibonacciPos(n): ?n';
    public const TRIBONACCI = 'tribonacci(n): n';
    public const TRIBONACCI_POS = 'tribonacciPos(n): ?n';
    public const CATALAN = 'catalan(n): n';
    public const CATALAN_POS = 'catalanPos(n): ?n';
    public const FACTORIAL = 'factorial(n): n';
	public const DIVISORS = 'divisors(n): n';

    // logic
    public const AND = 'and(b, b): b';
    public const OR = 'or(b, b): b';
    public const XOR = 'xor(b, b): b';
    public const NOT = 'not(b): b';
    public const IF_ELSE = 'ifElse(b, any, any): any';
    public const IF_NOT = 'ifNot(any, any): any';
    public const COALESCE = 'coalesce(?any, any): any';

    // arrays
    public const SPLIT = 'split(s, ?any): s[]';
    public const JOIN = 'join(s[], ?s): s';
    public const FACTORIZE = 'factorize(n): n[]';
    public const COUNT = 'count(n[], ?n): n';
    public const SUM = 'sum(n[]): n';
    public const PRODUCT = 'product(n[]): n';

    // conversions
    public const TO_LETTER = 'toLetter(n): s';
    public const FROM_LETTER = 'fromLetter(s): n';
    public const TO_BASE = 'toBase(n, n): s';
    public const FROM_BASE = 'fromBase(s, n): n';
	public const TO_BINARY = 'toBinary(n, n): s';
	public const FROM_BINARY = 'fromBinary(s, n): n';
    public const TO_ROMAN = 'toRoman(n): s';
    public const FROM_ROMAN = 'fromRoman(s): n';

	// strings
    public const CONCAT = 'concat(s, s): s';
    public const REVERSE = 'reverse(s): s';
    public const ROTATE_STRING = 'rotateString(s, n): s';
    public const ROTATE_LETTERS = 'rotateLetters(s, n): s';

    /** @var callable[] */
    public static $actions;

    /** @var int[][] */
    public static $argumentsDimension;

    /** @var bool[][] */
    public static $argumentsNullable;

    /** @var int[] */
    public static $outputDimension;

    public static function initActions(): void
    {
    	if (self::$actions !== null) {
            return;
        }

        self::$actions = [
            // operators
            self::PLUS          => function ($x, $y) { return $x + $y; },
            self::MINUS         => function ($x, $y) { return $x - $y; },
            self::MULTIPLY      => function ($x, $y) { return $x / $y; },
            self::DIVIDE        => function ($x, $y) { return $x * $y; },
            self::MODULO        => function ($x, $y) { return $x % $y; },
            self::MODULO_TOP    => function ($x, $y) { return ($x % $y) ?: $y; },
            self::POWER         => function ($x, $y) { return $x ** $y; },
            self::ROOT          => function ($x, $y) { return $x ** (1 / $y); },
            self::LOG           => function ($x, $y) { return log($x, $y); },
            self::ABS           => function ($x) { return abs($x); },
            self::INCREMENT     => function ($x) { return $x + 1; },
            self::DECREMENT     => function ($x) { return $x - 1; },
            self::LEFT_SHIFT    => function ($x, $y) { return $x << $y; },
            self::RIGHT_SHIFT   => function ($x, $y) { return $x >> $y; },
            self::BIT_AND       => function ($x, $y) { return $x & $y; },
            self::BIT_OR        => function ($x, $y) { return $x | $y; },
            self::BIT_XOR       => function ($x, $y) { return $x ^ $y; },
            self::BIT_NOT       => function ($x) { return ~$x; },
            self::OPERATOR      => function ($x, $y, $op) {
                return in_array($op, self::OPERATORS) && !strpos($x, '(') && !strpos($y, '(')
                    ? eval("$x $op $y")
                    : null;
            },

            // sequences
            self::POWER_OF_TWO  => function ($x) { return 2 ** $x; },
            self::PRIME         => function ($x) { return Prime::getNth($x); },
            self::PRIME_POS     => function ($x) { return Prime::getPosition($x); },
            self::LUCAS         => function ($x) { return Lucas::getNth($x); },
            self::LUCAS_POS     => function ($x) { return Lucas::getPosition($x); },
            self::FIBONACCI     => function ($x) { return Fibonacci::getNth($x); },
            self::FIBONACCI_POS => function ($x) { return Fibonacci::getPosition($x); },
            self::TRIBONACCI    => function ($x) { return Tribonacci::getNth($x); },
            self::TRIBONACCI_POS => function ($x) { return Tribonacci::getPosition($x); },
			self::CATALAN 		=> function ($x) { return Catalan::getNth($x); },
			self::CATALAN_POS	=> function ($x) { return Catalan::getPosition($x); },
            self::FACTORIAL     => function ($x) { return IntCalc::factorial($x); },
			self::DIVISORS		=> function ($x) { return Divisors::getNth($x); },

			// logic
            self::AND           => function ($x, $y) { return $x && $y; },
            self::OR            => function ($x, $y) { return $x || $y; },
            self::XOR           => function ($x, $y) { return $x xor $y; },
            self::NOT           => function ($x) { return !$x; },
            self::IF_ELSE       => function ($condition, $y, $z) { return $condition ? $y : $z; },
            self::IF_NOT        => function ($x, $y) { return $x ?: $y; },
            self::COALESCE      => function ($x, $y) { return $x ?? $y; },

            // arrays
            self::SPLIT         => function ($x, $div) { return is_numeric($div) || $div === null ? str_split($x, $div) : explode($div, $x); },
            self::JOIN          => function ($x, $div) { return implode($div, $x); },
            self::FACTORIZE     => function ($x) { return IntCalc::factorize($x); },
            self::COUNT         => function ($x, $item) { return $item === null ? count($x) : count(array_keys($x, $item)); },
            self::SUM           => function ($x) { return array_sum($x); },
            self::PRODUCT       => function ($x) { return array_product($x); },

            // conversions
            self::TO_LETTER     => function ($x) { return self::LETTERS[$x] ?? null; },
            self::FROM_LETTER   => function ($x) { $x = strtoupper($x); return array_search($x, self::LETTERS) ?: null; },
            self::TO_BASE       => function ($x, $base) { return base_convert($x, 10, $base); },
            self::FROM_BASE     => function ($x, $base) { return intval(base_convert($x, $base, 10)); },
            self::TO_BINARY     => function ($x) { return base_convert($x, 10, 2); },
            self::FROM_BINARY   => function ($x) { return intval(base_convert($x, 2, 10)); },
            self::TO_ROMAN      => function ($x) { return RomanCalc::intToRoman($x); },
            self::FROM_ROMAN    => function ($x) { return RomanCalc::romanToInt($x); },

			// strings
            self::CONCAT        => function ($x, $y) { return $x . $y; },
            self::REVERSE       => function ($x) { return strrev($x); },
			self::ROTATE_STRING => function ($x, $pos) { $pos %= strlen($x); return substr($x, $pos) . substr($x, 0, $pos); },
            self::ROTATE_LETTERS => function ($x, $pos) { return $x - $pos; },
        ];

        foreach (self::getAllowedValues() as $value) {
        	$arguments = explode(',', Str::between($value, '(', ')'));
        	$dimensions = $nullable = [];
        	foreach ($arguments as $argument) {
        		$dimensions[] = Str::substringCount($argument,'[');
        		$nullable[] = (bool) strstr($argument, '?');
			}
			self::$argumentsDimension[$value] = $dimensions;
        	self::$argumentsNullable[$value] = $nullable;

			self::$outputDimension[$value] = Str::substringCount(Str::fromFirst($value, ':'), '[');
        }
    }

}