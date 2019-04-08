<?php declare(strict_types=1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

class Baudot
{

	private const SHIFT = true;
	private const UNSHIFT = false;

	// order: 12345. usually sent as 54·123
	private const CODES = [
		'10000' => ['A', '1'],
		'11000' => ['/', '1/'],
		'01000' => ['E', '2'],
		'01100' => ['I', '3/'],
		'11100' => ['O', '5'],
		'10100' => ['U', '4'],
		'00100' => ['Y', '3'],
		'00110' => ['B', '8'],
		'10110' => ['C', '9'],
		'11110' => ['D', '0'],
		'01110' => ['F', '5/'],
		'01010' => ['G', '7'],
		'11010' => ['H', ''],
		'10010' => ['J', '6'],
		'00010' => [self::SHIFT, ''],
		'00011' => ['*', '*'],
		'10011' => ['K', '('],
		'11011' => ['L', '='],
		'01011' => ['M', ')'],
		'01111' => ['N', '£'],
		'11111' => ['P', '+'],
		'10111' => ['Q', '/'],
		'00111' => ['R', '-'],
		'00101' => ['S', '7/'],
		'10101' => ['T', ''],
		'11101' => ['V', ''],
		'01101' => ['W', '?'],
		'01001' => ['X', '9/'],
		'11001' => ['Z', ':'],
		'10001' => ['-', '.'],
		'00001' => ['', self::UNSHIFT],
	];

}
