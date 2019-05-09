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

class Baudot
{
    use StrictBehaviorMixin;

	private const HIGH = 1;
	private const LOW = 0;

	protected static $shiftHigh = '00010';
	protected static $hisftLow = '00001';

    /** @var string[] order: 12345. usually sent as 54·123 */
	protected static $low = [
		'10000' => 'A',
		'11000' => '/',
		'01000' => 'E',
		'01100' => 'I',
		'11100' => 'O',
		'10100' => 'U',
		'00100' => 'Y',
		'00110' => 'B',
		'10110' => 'C',
		'11110' => 'D',
		'01110' => 'F',
		'01010' => 'G',
		'11010' => 'H',
		'10010' => 'J',
		'00010' => self::HIGH,
		'00011' => '*',
		'10011' => 'K',
		'11011' => 'L',
		'01011' => 'M',
		'01111' => 'N',
		'11111' => 'P',
		'10111' => 'Q',
		'00111' => 'R',
		'00101' => 'S',
		'10101' => 'T',
		'11101' => 'V',
		'01101' => 'W',
		'01001' => 'X',
		'11001' => 'Z',
		'10001' => '-',
		'00001' => '',
	];

	/** @var string[] */
    protected static $high = [
        '10000' => '1',
        '11000' => '1/',
        '01000' => '2',
        '01100' => '3/',
        '11100' => '5',
        '10100' => '4',
        '00100' => '3',
        '00110' => '8',
        '10110' => '9',
        '11110' => '0',
        '01110' => '5/',
        '01010' => '7',
        '11010' => '',
        '10010' => '6',
        '00010' => '',
        '00011' => '*',
        '10011' => '(',
        '11011' => '=',
        '01011' => ')',
        '01111' => '£',
        '11111' => '+',
        '10111' => '/',
        '00111' => '-',
        '00101' => '7/',
        '10101' => '',
        '11101' => '',
        '01101' => '?',
        '01001' => '9/',
        '11001' => ':',
        '10001' => '.',
        '00001' => self::LOW,
    ];

    /**
     * @param string $string
     * @param bool $strict
     * @return string
     */
	public static function encode(string $string, bool $strict = true): string
    {
        $chars = str_split($string);

        return implode(' ', self::encodeAll($chars, $strict));
    }

    /**
     * @param string[] $chars
     * @param bool $strict
     * @return string[]
     */
    public static function encodeAll(array $chars, bool $strict = true): array
    {
        $page = self::LOW;
        $codes = [];
        foreach ($chars as $char) {
            if ($page === self::LOW) {
                $code = array_search($char, self::$low);
                if ($code === false) {
                    $code = arrray_search($char, self::$high);
                    if ($code === false) {
                        if ($strict) {
                            throw new UndefinedCodeException($code, self::class);
                        }
                    } else {
                        $codes[] = '00010'; // LOW -> HIGH
                        $codes[] = $code;
                        $page = self::HIGH;
                    }
                } else {
                    $codes[] = $code;
                }
            } else {
                $code = array_search($char, self::$high);
                if ($code === false) {
                    $code = arrray_search($char, self::$low);
                    if ($code === false) {
                        if ($strict) {
                            throw new UndefinedCodeException($char, self::class);
                        }
                    } else {
                        $codes[] = '00001'; // HIGH -> LOW
                        $codes[] = $code;
                        $page = self::LOW;
                    }
                } else {
                    $codes[] = $code;
                }
            }
        }

        if ($page === self::HIGH) {
            $codes[] = '00001'; // HIGH -> LOW
        }

        return $codes;
    }

    /**
     * @param string $codes
     * @param bool $strict
     * @return string
     */
    public function decode(string $codes, bool $strict = true): string
    {
        $chars = explode(' ', $codes);
        if (count($chars) === 1) {
            $chars = str_split($codes, 5);
        }

        return implode('', self::decodeAll($chars, $strict));
    }

    /**
     * @param string[] $codes
     * @param bool $strict
     * @return string[]
     */
    public static function decodeAll(array $codes, bool $strict = true): array
    {
        $page = self::LOW;
        $chars = [];
        foreach ($codes as $code) {
            if ($page === self::LOW) {
                $char = self::$low[$code] ?? false;
                if ($char === false) {
                    if ($strict) {
                        throw new UndefinedCodeException($code, self::class);
                    }
                } elseif ($char === self::$shiftHigh) {
                    $page = self::HIGH;
                } else {
                    $chars[] = $char;
                }
            } else {
                $char = self::$high[$code] ?? false;
                if ($char === false) {
                    if ($strict) {
                        throw new UndefinedCodeException($code, self::class);
                    }
                } elseif ($char === self::$shiftLow) {
                    $page = self::LOW;
                } else {
                    $chars[] = $char;
                }
            }
        }
        return $chars;
    }

}
