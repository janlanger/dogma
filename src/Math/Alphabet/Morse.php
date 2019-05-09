<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\Alphabet;

use Dogma\StrictBehaviorMixin;

class Morse
{
    use StrictBehaviorMixin;

    private const CODES = [
        'A' => '.-',
        'B' => '-...',
        'C' => '-.-.',
        'D' => '-..',
        'E' => '.',
        'F' => '..-.',
        'G' => '--.',
        'H' => '....',
        'I' => '..',
        'J' => '.---',
        'K' => '-.-',
        'L' => '.-..',
        'M' => '--',
        'N' => '-.',
        'O' => '---',
        'P' => '.--.',
        'Q' => '--.-',
        'R' => '.-.',
        'S' => '...',
        'T' => '-',
        'U' => '..-',
        'V' => '...-',
        'W' => '.--',
        'X' => '-..-',
        'Y' => '-.--',
        'Z' => '--..',
        '0' => '-----',
        '1' => '.----',
        '2' => '..---',
        '3' => '...--',
        '4' => '....-',
        '5' => '.....',
        '6' => '-....',
        '7' => '--...',
        '8' => '---..',
        '9' => '----.',
        '&' => '.-...',
        "'" => '.----.',
        '@' => '.--.-.',
        ')' => '-.--.-',
        '(' => '-.--.',
        ':' => '---...',
        ',' => '--..--',
        '=' => '-...-',
        '!' => '-.-.--',
        '.' => '.-.-.-',
        '-' => '-....-',
        '+' => '.-.-.',
        '"' => '.-..-.',
        '?' => '..--..',
        '/' => '-..-.',
    ];

    /**
     * @param string $string
     * @param bool $strict
     * @return string
     */
    public static function encode(string $string, bool $strict = true): string
    {
        $string = strtoupper($string);
        $codes = [];
        foreach (str_split($string) as $char) {
            if (isset(self::CODES[$char])) {
                $codes[] = self::CODES[$char];
            } elseif ($strict) {
                throw new UndefinedCodeException($char, self::class);
            }
        }
        return implode(' ', $codes);
    }

    /**
     * @param string[] $strings
     * @param bool $strict
     * @return string[]
     */
    public static function encodeAll(array $strings, bool $strict = true): array
    {
        $results = [];
        foreach ($strings as $string) {
            $results[] = self::encode($string, $strict);
        }
        return $results;
    }

    /**
     * @param string|string[] $codes
     * @param bool $strict
     * @return string|string[]
     */
    public static function decode($codes, bool $strict = true)
    {
        $chars = [];
        foreach (explode(' ', $codes) as $code) {
            $char = array_search(self::CODES[$code]);
            if ($char !== false) {
                $chars[] = $char;
            } elseif ($strict) {
                throw new UndefinedCodeException($code, self::class);
            }
        }

        return implode('', $chars);
    }

    /**
     * @param string[] $codes
     * @param bool $strict
     * @return string[]
     */
    public static function decodeAll(array $codes, bool $strict): array
    {
        $results = [];
        foreach ($codes as $code) {
            $results[] = self::decode($code, $strict);
        }
        return $results;
    }

}
