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

class Action extends StringEnum
{

    // n = number, s = string, b = bool, a = any

	// input
	public const SCALAR_INPUT = 'scalarInput(any): any';
	public const VECTOR_INPUT = 'vectorInput(any[]): any[]';
	public const MATRIX_INPUT = 'matrixInput(any[][]): any[][]';

    // operators
    public const PLUS = 'plus(n, n): n';
    public const MINUS = 'minus(n, n): n';
    public const MULTIPLY = 'multiply(n, n): n';
    public const DIVIDE = 'divide(n, n): n';
    public const MODULO = 'modulo(n, n): n';
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
    public const OPERATOR = 'operator(n, n, op): ?n';

    // sequences
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
    public const FACTORIZE = 'factorize(n): n[]'; // 60 -> 2, 2, 3, 5
    public const SPLIT = 'split(s, ?any): s[]'; // "A B C"," " -> [A, B, C]
    public const JOIN = 'join(s[], ?s): s'; // [1, 3, 5] -> 135
    public const FLATTEN = 'flatten(any[][]): any[]'; // [[1,2],[3,4]] -> [1,2,3,4]
    public const FILTER = 'filter(any[], ?s): any[]'; // [1,2,3,4],">2" -> [3,4]
    public const UNIQUE = 'unique(any[]): any[]'; // [1,1,2,2] -> [1,2]
    public const COUNT = 'count(n[], ?n): n'; // [1, 2, 3, 3],3 -> 2
    public const SUM = 'sum(n[]): n'; // [1, 3, 5] -> 9
    public const PRODUCT = 'product(n[]): n'; // [1, 3, 5] -> 15
    public const REDUCE = 'reduce(n[], op): ?n'; // [1, 3, 5],"+" -> 9

	// strings
    //public const FILTER = 'filter(s, s): s'; // "FILTER","E" -> "FILTR"
    public const TRANSLATE = 'translate(s, s, s): s'; // "FILTER","FL","LS" -> "LISTER"
    public const CONCAT = 'concat(s, s): s'; // "AB","CD" -> "ABCD"
    public const REVERSE = 'reverse(s): s'; // "LOOT" -> "TOOL"
    public const ROTATE_STRING = 'rotateString(s, n): s'; // "LOOT",2 -> "OTLO"
    public const ROTATE_LETTERS = 'rotateLetters(s, n): s'; // "LOOT",1 -> "MPPU"

    // conversions
    public const FROM_LETTER = 'fromLetter(s): n'; // 5 -> E
    public const TO_LETTER = 'toLetter(n): s'; // E -> 5
    public const FROM_BASE = 'fromBase(s, n): n'; // 00000110,2 -> 6
    public const TO_BASE = 'toBase(n, n): s'; // 6,2 -> 00000110
    public const FROM_BINARY = 'fromBinary(s, n): n'; // 00000110 -> 6
    public const TO_BINARY = 'toBinary(n, n): s'; // 6 -> 00000110
    public const FROM_ROMAN = 'fromRoman(s): n'; // MDCCLXII -> 1762
    public const TO_ROMAN = 'toRoman(n): s'; // 1762 -> MDCXLII
    public const FROM_MORSE = 'fromMorse(s): s'; // ... --- ... -> SOS
    public const TO_MORSE = 'toMorse(s): s'; // SOS -> ... --- ...
    public const FROM_BAUDOT = 'fromBaudot(s): s'; // 01000 -> E
    public const TO_BAUDOT = 'toBaudot(s): s'; // E -> 01000
    public const FROM_ITA2 = 'fromIta2(s): s'; // 10000 -> E
    public const TO_ITA2 = 'toIta2(s): s'; // E -> 10000

}