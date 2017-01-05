<?php

namespace Dogma;

class BitSize
{
    use \Dogma\StaticClassMixin;

    const BITS_8 = 8;
    const BITS_16 = 16;
    const BITS_24 = 24;
    const BITS_32 = 32;
    const BITS_64 = 64;

    const DEFAULT_INT_SIZE = PHP_INT_SIZE * 8;
    const DEFAULT_FLOAT_SIZE = self::BITS_64;

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
    public static function checkIntSize(int $size)
    {
        $sizes = BitSize::getIntSizes();
        if (!Arr::contains($sizes, $size)) {
            throw new \Dogma\InvalidSizeException(Type::INT, $size, $sizes);
        }
    }

    /**
     * @param int $size
     * @throws \Dogma\InvalidSizeException
     */
    public static function checkFloatSize(int $size)
    {
        $sizes = BitSize::getFloatSizes();
        if (!Arr::contains($sizes, $size)) {
            throw new \Dogma\InvalidSizeException(Type::FLOAT, $size, $sizes);
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
                self::BITS_16 => [0, 65536],
                self::BITS_24 => [0, 16777216],
                self::BITS_32 => [0, 4294967296],
                self::BITS_64 => [0, PHP_INT_MAX], // this is actually 63 bits, since PHP int is always signed
            ],
            Sign::SIGNED => [
                self::BITS_8 => [-128, 127],
                self::BITS_16 => [-32768, 32767],
                self::BITS_24 => [-8388608, 8388607],
                self::BITS_32 => [-2147483648, 2147483647],
                self::BITS_64 => [PHP_INT_MIN, PHP_INT_MAX],
            ],
        ];

        return $bounds[$sign][$size];
    }

}
