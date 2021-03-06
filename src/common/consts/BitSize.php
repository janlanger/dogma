<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma;

use const PHP_INT_MAX;
use const PHP_INT_MIN;
use const PHP_INT_SIZE;

class BitSize
{
    use StaticClassMixin;

    public const BITS_8 = 8;
    public const BITS_16 = 16;
    public const BITS_24 = 24;
    public const BITS_32 = 32;
    public const BITS_48 = 48;
    public const BITS_64 = 64;

    public const DEFAULT_INT_SIZE = PHP_INT_SIZE * 8;
    public const DEFAULT_FLOAT_SIZE = self::BITS_64;

    /**
     * @return int[]
     */
    public static function getIntSizes(): array
    {
        return [
            self::BITS_8,
            self::BITS_16,
            self::BITS_24,
            self::BITS_32,
            self::BITS_48,
            self::BITS_64,
        ];
    }

    /**
     * @return int[]
     */
    public static function getFloatSizes(): array
    {
        return [
            self::BITS_32,
            self::BITS_64,
        ];
    }

    /**
     * @param int $size
     * @throws \Dogma\InvalidSizeException
     */
    public static function checkIntSize(int $size): void
    {
        $sizes = self::getIntSizes();
        if (!Arr::contains($sizes, $size)) {
            throw new InvalidSizeException(Type::INT, $size, $sizes);
        }
    }

    /**
     * @param int $size
     * @throws \Dogma\InvalidSizeException
     */
    public static function checkFloatSize(int $size): void
    {
        $sizes = self::getFloatSizes();
        if (!Arr::contains($sizes, $size)) {
            throw new InvalidSizeException(Type::FLOAT, $size, $sizes);
        }
    }

    /**
     * @param int $size
     * @param string $sign
     * @return int[]
     */
    public static function getIntRange(int $size, string $sign = Sign::SIGNED): array
    {
        $bounds = [
            Sign::UNSIGNED => [
                self::BITS_8 => [0, 255],
                self::BITS_16 => [0, 65535],
                self::BITS_24 => [0, 16777215],
                self::BITS_32 => [0, 4294967295],
                self::BITS_48 => [0, 281474976710655],
                self::BITS_64 => [0, PHP_INT_MAX], // this is actually 63 bits, since PHP int is always signed
            ],
            Sign::SIGNED => [
                self::BITS_8 => [-128, 127],
                self::BITS_16 => [-32768, 32767],
                self::BITS_24 => [-8388608, 8388607],
                self::BITS_32 => [-2147483648, 2147483647],
                self::BITS_48 => [-140737488355328, 140737488355327],
                self::BITS_64 => [PHP_INT_MIN, PHP_INT_MAX],
            ],
        ];

        return $bounds[$sign][$size];
    }

}
