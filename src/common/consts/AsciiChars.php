<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma;

class AsciiChars
{
    use StaticClassMixin;

    public const SPECIAL_WITHOUT_WHITESPACE = [
        Char::NUL, Char::SOH, Char::STX, Char::ETX, Char::EOT, Char::ENQ, Char::ACK, Char::BEL, Char::BS, Char::VT,
        Char::FF, Char::SO, Char::SI, Char::DLE, Char::DC1, Char::DC2, Char::DC3, Char::DC4, Char::NAK, Char::SYN,
        Char::ETB, Char::CAN, Char::EM, Char::SUB, Char::ESC, Char::FS, Char::GS, Char::RS, Char::US, Char::DEL,
    ];
    public const SPECIAL_CHARS = self::SPECIAL_WITHOUT_WHITESPACE + ["\t", "\r", "\n"];

    public const NUMBERS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    public const UPPER_LETTERS = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    public const LOWER_LETTERS = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

    public const OPERATORS = ['+', '-', '*', '/', '<', '>', '=', '~', '^'];
    public const PUNCTUATION = [',', '.', ':', ';', '!', '?'];
    public const BRACKETS = ['(', ')', '[', ']', '{', '}'];
    public const QUOTES = ['"', "'", '`'];
    public const OTHER = ['#', '$', '%', '&', '@', '_', '|', '\\'];

    public const WHITESPACE = [' ', "\t", "\r", "\n"];

    public const LETTERS = self::UPPER_LETTERS + self::LOWER_LETTERS;
    public const ALPHANUMERIC = self::NUMBERS + self::LETTERS;
    public const SYMBOLS = self::OPERATORS + self::PUNCTUATION + self::BRACKETS + self::QUOTES + self::OTHER;
    public const PRINTABLE = self::ALPHANUMERIC + self::SYMBOLS + self::WHITESPACE;
    public const ALL = self::ALPHANUMERIC + self::SYMBOLS + self::WHITESPACE + self::SPECIAL_WITHOUT_WHITESPACE;

}
