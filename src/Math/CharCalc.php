<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math;

use Dogma\AsciiChars;
use Dogma\StaticClassMixin;

class CharCalc
{
    use StaticClassMixin;

    public static function increment(string $string, ?string $charList = null): string
    {
        if ($charList === null) {
            return ++$string;
        }
        ///
    }

    public static function decrement(string $string, ?string $charList = null): string
    {
        if ($charList === null && strlen($string) === 1) {
            return self::rotateLetters($string, -1);
        }
        ///
    }

    public static function rotateLetters(string $string, int $pos): string
    {
        static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';

        $pos %= 26;
        if (!$pos) {
            return $string;
        }
        if ($pos < 0) {
            $pos += 26;
        }
        if ($pos === 13) {
            return str_rot13($string);
        }
        $replace = substr($letters, $pos * 2) . substr($letters, 0, $pos * 2);

        return strtr($string, $letters, $replace);
    }

    public static function rotateString(string $string, int $pos): string
    {
        $pos %= strlen($string);

        return substr($string, $pos) . substr($string, 0, $pos);
    }

    public static function expandCharList(string $charList): string
    {
        $charList = count_chars(preg_replace_callback('/.-./', function (array $match): string {
            return implode('', range($match[0][0], $match[0][2]));
        }, $charList), 3);

        return $charList;
    }

}
