<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

class Ita2
{

	private const SHIFT = true;
	private const UNSHIFT = false;

	// order 12345. sent as 12345
	private const CODES = [
		'00000' => [null, null],
		'00010' => ["\r", "\r"],
		'01000' => ["\n", "\n"],
		'00100' => [' ', ' '],
		'11101' => ['Q', '1'],
		'11001' => ['W', '2'],
		'10000' => ['E', '3'],
		'01010' => ['R', '4'],
		'00001' => ['T', '5'],
		'10101' => ['Y', '6'],
		'11100' => ['U', '7'],
		'01100' => ['I', '8'],
		'00011' => ['O', '9'],
		'01101' => ['P', '0'],
		'11000' => ['A', '–'],
		'10100' => ['S', "\b"],
		'10010' => ['D', '$'],
		'10110' => ['F', '!'],
		'01011' => ['G', '&'],
		'00101' => ['H', '£'],
		'11010' => ['J', "\b"],
		'11110' => ['K', '('],
		'01001' => ['L', ')'],
		'10001' => ['Z', '+'],
		'10111' => ['X', '/'],
		'01110' => ['C', ':'],
		'01111' => ['V', '='],
		'10011' => ['B', '?'],
		'00110' => ['N', ','],
		'00111' => ['M', '.'],
		'11011' => [self::SHIFT, ''],
		'11111' => ['', self::UNSHIFT],
	];
	
}
