<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\Alphabet;

/**
 * Internation Telegraph Alphabet 2 (version 1 is Baudot code)
 */
class Ita2 extends Baudot
{

    protected static $shiftHigh = '11011';
    protected static $hisftLow = '11111';

    /** @var string[] order 12345. sent as 12345 */
	protected static $low = [
		'00000' => null,
		'00010' => "\r",
		'01000' => "\n",
		'00100' => ' ',
		'11101' => 'Q',
		'11001' => 'W',
		'10000' => 'E',
		'01010' => 'R',
		'00001' => 'T',
		'10101' => 'Y',
		'11100' => 'U',
		'01100' => 'I',
		'00011' => 'O',
		'01101' => 'P',
		'11000' => 'A',
		'10100' => 'S',
		'10010' => 'D',
		'10110' => 'F',
		'01011' => 'G',
		'00101' => 'H',
		'11010' => 'J',
		'11110' => 'K',
		'01001' => 'L',
		'10001' => 'Z',
		'10111' => 'X',
		'01110' => 'C',
		'01111' => 'V',
		'10011' => 'B',
		'00110' => 'N',
		'00111' => 'M',
		'11011' => self::HIGH,
		'11111' => '',
	];

	/** @var string[] */
    protected static $high = [
        '00000' => null,
        '00010' => "\r",
        '01000' => "\n",
        '00100' => ' ',
        '11101' => '1',
        '11001' => '2',
        '10000' => '3',
        '01010' => '4',
        '00001' => '5',
        '10101' => '6',
        '11100' => '7',
        '01100' => '8',
        '00011' => '9',
        '01101' => '0',
        '11000' => '–',
        '10100' => "\b",
        '10010' => '$',
        '10110' => '!',
        '01011' => '&',
        '00101' => '£',
        '11010' => "\b",
        '11110' => '(',
        '01001' => ')',
        '10001' => '+',
        '10111' => '/',
        '01110' => ':',
        '01111' => '=',
        '10011' => '?',
        '00110' => ',',
        '00111' => '.',
        '11011' => '',
        '11111' => self::LOW,
    ];

}
