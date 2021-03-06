<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma;

use function array_chunk;
use function array_column;
use function array_combine;
use function array_count_values;
use function array_diff;
use function array_diff_assoc;
use function array_diff_key;
use function array_diff_uassoc;
use function array_diff_ukey;
use function array_filter;
use function array_flip;
use function array_intersect;
use function array_intersect_assoc;
use function array_intersect_key;
use function array_intersect_uassoc;
use function array_intersect_ukey;
use function array_key_exists;
use function array_keys;
use function array_map;
use function array_merge;
use function array_pad;
use function array_product;
use function array_push;
use function array_rand;
use function array_reduce;
use function array_replace;
use function array_reverse;
use function array_search;
use function array_slice;
use function array_splice;
use function array_sum;
use function array_udiff;
use function array_udiff_assoc;
use function array_udiff_uassoc;
use function array_uintersect;
use function array_uintersect_assoc;
use function array_uintersect_uassoc;
use function array_unique;
use function array_unshift;
use function array_values;
use function arsort;
use function asort;
use function count;
use function end;
use function is_array;
use function iterator_to_array;
use function krsort;
use function ksort;
use function max;
use function min;
use function range;
use function reset;
use function shuffle;
use function uasort;
use function uksort;

class Arr
{
    use StaticClassMixin;

    /** @internal */
    private const PRESERVE_KEYS = true;

    /**
     * @param mixed[] $keys
     * @param mixed[] $values
     * @return mixed[]
     */
    public static function combine(array $keys, array $values): array
    {
        return array_combine($keys, $values);
    }

    /**
     * @param iterable|mixed[] $that
     * @return mixed[]
     */
    public static function toArray(iterable $that): array
    {
        if (is_array($that)) {
            return $that;
        } elseif ($that instanceof ImmutableArray) {
            return $that->toArray();
        } elseif ($that instanceof \Traversable) {
            return iterator_to_array($that);
        } else {
            throw new InvalidTypeException(Type::PHP_ARRAY, $that);
        }
    }

    /**
     * @param mixed[] $array
     * @return \Dogma\ArrayIterator
     */
    public static function iterate(array $array): ArrayIterator
    {
        return new ArrayIterator($array);
    }

    /**
     * @param mixed[] $array
     * @return \Dogma\ReverseArrayIterator
     */
    public static function backwards(array $array): ReverseArrayIterator
    {
        return new ReverseArrayIterator($array);
    }

    /**
     * @param int|string $start
     * @param int|string $end
     * @param int $step >= 1
     * @return mixed[]
     */
    public static function range($start, $end, int $step = 1): array
    {
        Check::min($step, 1);

        return range($start, $end, $step);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function keys(array $array): array
    {
        return array_keys($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function values(array $array): array
    {
        return array_values($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed
     */
    public static function randomKey(array $array)
    {
        return array_rand($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed
     */
    public static function randomValue(array $array)
    {
        return $array[array_rand($array)];
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     */
    public static function doForEach(array $array, callable $function): void
    {
        foreach ($array as $value) {
            $function($value);
        }
    }

    // queries ---------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @return bool
     */
    public static function isEmpty(array $array): bool
    {
        return empty($array);
    }

    /**
     * @param mixed[] $array
     * @return bool
     */
    public static function isNotEmpty(array $array): bool
    {
        return !empty($array);
    }

    /**
     * @param mixed[] $array
     * @param mixed $value
     * @return bool
     */
    public static function contains(array $array, $value): bool
    {
        return array_search($value, $array, Type::STRICT) !== false;
    }

    /**
     * @param mixed[] $array
     * @param mixed $value
     * @param int $from
     * @return int|string|null
     */
    public static function indexOf(array $array, $value, int $from = 0)
    {
        if ($from > 0) {
            return self::indexOf(self::drop($array, $from), $value);
        }
        $result = array_search($value, $array, Type::STRICT);

        return $result === false ? null : $result;
    }

    /**
     * @param mixed[] $array
     * @param mixed $value
     * @return int[]|string[]
     */
    public static function indexesOf(array $array, $value): array
    {
        return array_keys($array, $value, Type::STRICT);
    }

    /**
     * @param mixed[] $array
     * @param mixed $value
     * @param int $end
     * @return int|string|null
     */
    public static function lastIndexOf(array $array, $value, $end = null)
    {
        if ($end !== null) {
            return self::last(self::indexesOf(self::take($array, $end), $value));
        }
        return self::last(self::indexesOf($array, $value));
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param int $from
     * @return int|string|null
     */
    public static function indexWhere(array $array, callable $function, int $from = 0)
    {
        foreach (self::drop($array, $from) as $key => $value) {
            if ($function($value)) {
                return $key;
            }
        }
        return null;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param int $end
     * @return int|string|null
     */
    public static function lastIndexWhere(array $array, callable $function, ?int $end = null)
    {
        return self::indexWhere(self::reverse(self::take($array, $end)), $function);
    }

    /**
     * @param mixed[] $array
     * @param mixed $key
     * @return bool
     */
    public static function containsKey(array $array, $key): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return bool
     */
    public static function exists(array $array, callable $function): bool
    {
        foreach ($array as $value) {
            if ($function($value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return bool
     */
    public static function forAll(array $array, callable $function): bool
    {
        foreach ($array as $value) {
            if (!$function($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed|null
     */
    public static function find(array $array, callable $function)
    {
        foreach ($array as $value) {
            if ($function($value)) {
                return $value;
            }
        }
        return null;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return int
     */
    public static function prefixLength(array $array, callable $function): int
    {
        return self::segmentLength($array, $function, 0);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param int $from
     * @return int
     */
    public static function segmentLength(array $array, callable $function, int $from = 0): int
    {
        $i = 0;
        foreach (self::drop($array, $from) as $value) {
            if (!$function($value)) {
                break;
            }
            $i++;
        }
        return $i;
    }

    // stats -----------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return int
     */
    public static function count(array $array, ?callable $function = null): int
    {
        if ($function === null) {
            return count($array);
        }
        $count = 0;
        foreach ($array as $value) {
            if ($function($value)) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Alias of count() without params
     * @param mixed[] $array
     * @return int
     */
    public static function size(array $array): int
    {
        return count($array);
    }

    /**
     * @param mixed[] $array
     * @return int[]|string[]
     */
    public static function countValues(array $array): array
    {
        return array_count_values($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed|null
     */
    public static function max(array $array)
    {
        if (empty($array)) {
            return null;
        }
        return max($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed|null
     */
    public static function min(array $array)
    {
        if (empty($array)) {
            return null;
        }
        return min($array);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed|null
     */
    public static function maxBy(array $array, callable $function)
    {
        if (empty($array)) {
            return null;
        }
        $max = self::max(self::map($array, $function));
        return self::find($array, function ($value) use ($max, $function) {
            return $function($value) === $max;
        });
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed|null
     */
    public static function minBy(array $array, callable $function)
    {
        if (empty($array)) {
            return null;
        }
        $min = self::min(self::map($array, $function));
        return self::find($array, function ($value) use ($min, $function) {
            return $function($value) === $min;
        });
    }

    /**
     * @param mixed[] $array
     * @return int|float
     */
    public static function product(array $array)
    {
        return array_product($array);
    }

    /**
     * @param mixed[] $array
     * @return int|float
     */
    public static function sum(array $array)
    {
        return array_sum($array);
    }

    // comparison ------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param mixed[] $slice
     * @return bool
     */
    public static function containsSlice(array $array, array $slice): bool
    {
        return self::indexOfSlice($array, $slice, 0) !== null;
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $slice
     * @param int $from
     * @return int|null
     */
    public static function indexOfSlice(array $array, array $slice, int $from = 0): ?int
    {
        $that = self::drop($array, $from);
        while (!empty($that)) {
            if (self::startsWith($that, $slice)) {
                return $from;
            }
            $from++;
            $that = self::tail($that);
        }

        return null;
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $other
     * @param callable $function
     * @return bool
     */
    public static function corresponds(array $array, array $other, callable $function): bool
    {
        if (count($array) !== count($other)) {
            return false;
        }
        $iterator = new ArrayIterator($array);
        $iterator->rewind();
        foreach ($other as $value) {
            if (!$iterator->valid() || !$function($iterator->current(), $value)) {
                return false;
            }
            $iterator->next();
        }
        return true;
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $other
     * @return bool
     */
    public static function hasSameElements(array $array, array $other): bool
    {
        return self::corresponds($array, $other, function ($a, $b) {
            return $a === $b;
        });
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $slice
     * @param int $from
     * @return bool
     */
    public static function startsWith(array $array, array $slice, int $from = 0): bool
    {
        $iterator = new ArrayIterator(self::drop($array, $from));
        $iterator->rewind();
        foreach ($slice as $value) {
            if ($iterator->valid() && $value === $iterator->current()) {
                $iterator->next();
            } else {
                return false;
            }
        }
        return true;
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $slice
     * @return bool
     */
    public static function endsWith(array $array, array $slice): bool
    {
        return self::startsWith($array, $slice, count($array) - count($slice));
    }

    // transforming ----------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed|null $init
     * @return mixed|null
     */
    public static function fold(array $array, callable $function, $init = null)
    {
        return self::foldLeft($array, $function, $init);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed|null $init
     * @return mixed|null
     */
    public static function foldLeft(array $array, callable $function, $init = null)
    {
        return array_reduce($array, $function, $init);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed|null $init
     * @return mixed|null
     */
    public static function foldRight(array $array, callable $function, $init = null)
    {
        foreach (new ReverseArrayIterator($array) as $value) {
            $init = $function($value, $init);
        }
        return $init;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed|null
     */
    public static function reduce(array $array, callable $function)
    {
        return self::reduceLeft($array, $function);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed|null
     */
    public static function reduceLeft(array $array, callable $function)
    {
        if (empty($array)) {
            return null;
        }
        return self::foldLeft(self::tail($array), $function, self::head($array));
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed|null
     */
    public static function reduceRight(array $array, callable $function)
    {
        if (empty($array)) {
            return null;
        }
        return self::foldRight(self::init($array), $function, self::last($array));
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed $init
     * @return mixed[]
     */
    public static function scanLeft(array $array, callable $function, $init): array
    {
        $res = [];
        $res[] = $init;
        foreach ($array as $value) {
            $res[] = $init = $function($init, $value);
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed $init
     * @return mixed[]
     */
    public static function scanRight(array $array, callable $function, $init): array
    {
        $res = [];
        $res[] = $init;
        foreach (new ReverseArrayIterator($array) as $value) {
            $init = $function($value, $init);
            array_unshift($res, $init);
        }
        return $res;
    }

    // slicing ---------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @return mixed|null
     */
    public static function head(array $array)
    {
        if (count($array) === 0) {
            return null;
        }
        return reset($array);
    }

    /**
     * Alias of head()
     * @param mixed[] $array
     * @return mixed|null
     */
    public static function first(array $array)
    {
        if (count($array) === 0) {
            return null;
        }
        return reset($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed|null
     */
    public static function last(array $array)
    {
        if (count($array) === 0) {
            return null;
        }
        return end($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function init(array $array): array
    {
        return self::slice($array, 0, -1);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function tail(array $array): array
    {
        return self::drop($array, 1);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function inits(array $array): array
    {
        $res = [$array];
        $that = $array;
        while (!empty($that)) {
            $res[] = $that = self::init($that);
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function tails(array $array): array
    {
        $res = [$array];
        $that = $array;
        while (!empty($that)) {
            $res[] = $that = self::tail($that);
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @return mixed[] (mixed $head, static $tail)
     */
    public static function headTail(array $array): array
    {
        return [self::head($array), self::tail($array)];
    }

    /**
     * @param mixed[] $array
     * @return mixed[] (static $init, mixed $last)
     */
    public static function initLast(array $array): array
    {
        return [self::init($array), self::last($array)];
    }

    /**
     * @param mixed[] $array
     * @param int $from
     * @param int $length
     * @return mixed[]
     */
    public static function slice(array $array, int $from, ?int $length = null): array
    {
        return array_slice($array, $from, $length, self::PRESERVE_KEYS);
    }

    /**
     * @param mixed[] $array
     * @param int $size
     * @return mixed[]
     */
    public static function chunks(array $array, int $size): array
    {
        return array_chunk($array, $size, self::PRESERVE_KEYS);
    }

    /**
     * @param mixed[] $array
     * @param int $size
     * @param int $step
     * @return mixed[]
     */
    public static function sliding(array $array, int $size, int $step = 1): array
    {
        $res = [];
        for ($i = 0; $i <= count($array) - $size + $step - 1; $i += $step) {
            $res[] = self::slice($array, $i, $size);
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param int $count
     * @return mixed[]
     */
    public static function drop(array $array, int $count): array
    {
        return self::slice($array, $count, count($array));
    }

    /**
     * @param mixed[] $array
     * @param int $count
     * @return mixed[]
     */
    public static function dropRight(array $array, int $count): array
    {
        return self::slice($array, 0, count($array) - $count);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function dropWhile(array $array, callable $function): array
    {
        $res = [];
        $go = false;
        foreach ($array as $key => $value) {
            if (!$function($value)) {
                $go = true;
            }
            if ($go) {
                $res[$key] = $value;
            }
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param int $length
     * @param mixed $value
     * @return mixed[]
     */
    public static function padTo(array $array, int $length, $value): array
    {
        return array_pad($array, $length, $value);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[][] (static $l, static $r)
     */
    public static function span(array $array, callable $function): array
    {
        $l = [];
        $r = [];
        $toLeft = true;
        foreach ($array as $key => $value) {
            $toLeft = $toLeft && $function($value);
            if ($toLeft) {
                $l[$key] = $value;
            } else {
                $r[$key] = $value;
            }
        }
        return [$l, $r];
    }

    /**
     * @param mixed[] $array
     * @param int|null $count
     * @return mixed[]
     */
    public static function take(array $array, ?int $count = null): array
    {
        return self::slice($array, 0, $count);
    }

    /**
     * @param mixed[] $array
     * @param int $count
     * @return mixed[]
     */
    public static function takeRight(array $array, int $count): array
    {
        return self::slice($array, -$count, $count);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function takeWhile(array $array, callable $function): array
    {
        $res = [];
        foreach ($array as $key => $value) {
            if (!$function($value)) {
                break;
            }
            $res[$key] = $value;
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param int $positions
     * @return mixed[]
     */
    public static function rotateLeft(array $array, int $positions = 1): array
    {
        if ($array === []) {
            return $array;
        }
        $positions = $positions % count($array);

        return array_merge(array_slice($array, $positions), array_slice($array, 0, $positions));
    }

    /**
     * @param mixed[] $array
     * @param int $positions
     * @return mixed[]
     */
    public static function rotateRight(array $array, int $positions = 1): array
    {
        if ($array === []) {
            return $array;
        }
        $positions = $positions % count($array);

        return array_merge(array_slice($array, -$positions), array_slice($array, 0, -$positions));
    }

    // filtering -------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function collect(array $array, callable $function): array
    {
        return self::filter(self::map($array, $function));
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function filter(array $array, ?callable $function = null): array
    {
        if ($function) {
            return array_filter($array, $function);
        } else {
            return array_filter($array);
        }
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function filterKeys(array $array, callable $function): array
    {
        $res = [];
        foreach ($array as $key => $value) {
            if ($function($key)) {
                $res[$key] = $value;
            }
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function filterNot(array $array, callable $function): array
    {
        return self::filter($array, function ($value) use ($function) {
            return !$function($value);
        });
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[][] (mixed[] $fist, mixed[] $second)
     */
    public static function partition(array $array, callable $function): array
    {
        $a = [];
        $b = [];
        foreach ($array as $key => $value) {
            if ($function($value)) {
                $a[$key] = $value;
            } else {
                $b[$key] = $value;
            }
        }
        return [$a, $b];
    }

    // mapping ---------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function flatMap(array $array, callable $function): array
    {
        return self::flatten(self::map($array, $function));
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function flatten(array $array): array
    {
        $res = [];
        foreach ($array as $values) {
            if (is_array($values)) {
                foreach (self::flatten($values) as $value) {
                    $res[] = $value;
                }
            } else {
                $res[] = $values;
            }
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function groupBy(array $array, callable $function): array
    {
        $res = [];
        foreach ($array as $key => $value) {
            $groupKey = $function($value);
            $res[$groupKey][$key] = $value;
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function map(array $array, callable $function): array
    {
        return array_map($function, $array);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function mapPairs(array $array, callable $function): array
    {
        return self::remap($array, function ($key, $value) use ($function) {
            return [$key => $function($key, $value)];
        });
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @return mixed[]
     */
    public static function remap(array $array, callable $function): array
    {
        $res = [];
        foreach ($array as $key => $value) {
            foreach ($function($key, $value) as $newKey => $newValue) {
                $res[$newKey] = $newValue;
            }
        }
        return $res;
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function flip(array $array): array
    {
        return array_flip($array);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function transpose(array $array): array
    {
        if (empty($array)) {
            return [];
        }
        array_unshift($array, null);
        $array = array_map(...$array);
        foreach ($array as $key => $value) {
            $array[$key] = (array) $value;
        }
        return $array;
    }

    /**
     * @param mixed[][] $array
     * @param mixed $valueKey
     * @param mixed|null $indexKey
     * @return mixed[]
     */
    public static function column(array $array, $valueKey, $indexKey = null): array
    {
        return array_column($array, $valueKey, $indexKey);
    }

    // sorting ---------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function reverse(array $array): array
    {
        return array_reverse($array, self::PRESERVE_KEYS);
    }

    /**
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function shuffle(array $array): array
    {
        $arr = $array;
        shuffle($arr);
        return $arr;
    }

    /**
     * @param mixed[] $array
     * @param int $flags
     * @return mixed[]
     */
    public static function sort(array $array, int $flags = Sorting::REGULAR): array
    {
        $arr = $array;
        if ($flags & Order::DESCENDING) {
            arsort($arr, $flags);
        } else {
            asort($arr, $flags);
        }
        return $arr;
    }

    /**
     * @param mixed[] $array
     * @param int $flags
     * @return mixed[]
     */
    public static function sortKeys(array $array, int $flags = Sorting::REGULAR): array
    {
        $arr = $array;
        if ($flags & Order::DESCENDING) {
            krsort($arr, $flags);
        } else {
            ksort($arr, $flags);
        }
        return $arr;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param int $flags
     * @return mixed[]
     */
    public static function sortWith(array $array, callable $function, int $flags = Order::ASCENDING): array
    {
        $arr = $array;
        uasort($arr, $function);
        if ($flags & Order::DESCENDING) {
            $arr = array_reverse($arr);
        }
        return $arr;
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param int $flags
     * @return mixed[]
     */
    public static function sortKeysWith(array $array, callable $function, int $flags = Order::ASCENDING): array
    {
        $arr = $array;
        uksort($arr, $function);
        if ($flags & Order::DESCENDING) {
            $arr = array_reverse($arr);
        }
        return $arr;
    }

    /**
     * @param mixed[] $array
     * @param int $sortFlags
     * @return mixed[]
     */
    public static function distinct(array $array, int $sortFlags = Sorting::REGULAR): array
    {
        return array_unique($array, $sortFlags);
    }

    // merging ---------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param mixed ...$values
     * @return mixed[]
     */
    public static function append(array $array, ...$values): array
    {
        return self::appendAll($array, $values);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $values
     * @return mixed[]
     */
    public static function appendAll(array $array, array $values): array
    {
        foreach ($values as $value) {
            $array[] = $value;
        }
        return $array;
    }

    /**
     * @param mixed[] $array
     * @param mixed ...$values
     * @return mixed[]
     */
    public static function prepend(array $array, ...$values): array
    {
        return self::prependAll($array, $values);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $values
     * @return mixed[]
     */
    public static function prependAll(array $array, array $values): array
    {
        $values = new ReverseArrayIterator($values);
        foreach ($values as $value) {
            array_unshift($array, $value);
        }
        return $array;
    }

    /**
     * @param mixed[] $array
     * @param mixed $find
     * @param mixed $replace
     * @return mixed[]
     */
    public static function replace(array $array, $find, $replace): array
    {
        return array_replace($array, [$find => $replace]);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $replacements
     * @return mixed[]
     */
    public static function replaceAll(array $array, array $replacements): array
    {
        return array_replace($array, $replacements);
    }

    /**
     * @param mixed[] $array
     * @param int $from
     * @param int $length
     * @return mixed[]
     */
    public static function remove(array $array, int $from, int $length = 0): array
    {
        array_splice($array, $from, $length);
        return $array;
    }

    /**
     * @param mixed[] $array
     * @param int $from
     * @param mixed[] $patch
     * @param int $length
     * @return mixed[]
     */
    public static function patch(array $array, int $from, array $patch, ?int $length = null): array
    {
        if ($length === null) {
            $length = count($patch);
        }
        array_splice($array, $from, $length, $patch);
        return $array;
    }

    /**
     * @param mixed[] $array
     * @param int $from
     * @param mixed[] $patch
     * @return mixed[]
     */
    public static function insert(array $array, int $from, array $patch): array
    {
        array_splice($array, $from, 0, $patch);
        return $array;
    }

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function merge(array $array, array ...$args): array
    {
        return array_merge($array, ...$args);
    }

    // diffing ---------------------------------------------------------------------------------------------------------

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function diff(array $array, array ...$args): array
    {
        return array_diff($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function diffWith(array $array, callable $function, array ...$args): array
    {
        array_push($args, $function);

        return array_udiff($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function diffKeys(array $array, array ...$args): array
    {
        return array_diff_key($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function diffKeysWith(array $array, callable $function, array ...$args): array
    {
        $args[] = $function;
        return array_diff_ukey($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @lastParam callable|null $function
     * @return mixed[]
     */
    public static function diffPairs(array $array, array ...$args): array
    {
        return array_diff_assoc($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param callable|null $function
     * @param callable|null $keysFunction
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function diffPairsWith(array $array, ?callable $function, ?callable $keysFunction, array ...$args): array
    {
        if ($function && $keysFunction) {
            $args[] = $function;
            $args[] = $keysFunction;
            return array_udiff_uassoc($array, ...$args);
        } elseif ($function && !$keysFunction) {
            $args[] = $function;
            return array_udiff_assoc($array, ...$args);
        } elseif (!$function && $keysFunction) {
            $args[] = $keysFunction;
            return array_diff_uassoc($array, ...$args);
        } else {
            return array_diff_assoc($array, ...$args);
        }
    }

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function intersect(array $array, array ...$args): array
    {
        return array_intersect($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function intersectWith(array $array, callable $function, array ...$args): array
    {
        $args[] = $function;
        return array_uintersect($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function intersectKeys(array $array, array ...$args): array
    {
        return array_intersect_key($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param callable $function
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function intersectKeysWith(array $array, callable $function, array ...$args): array
    {
        $args[] = $function;
        return array_intersect_ukey($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function intersectPairs(array $array, array ...$args): array
    {
        return array_intersect_assoc($array, ...$args);
    }

    /**
     * @param mixed[] $array
     * @param callable|null $function
     * @param callable|null $keysFunction
     * @param mixed[] ...$args
     * @return mixed[]
     */
    public static function intersectPairsWith(array $array, ?callable $function, ?callable $keysFunction, array ...$args): array
    {
        if ($function && $keysFunction) {
            $args[] = $function;
            $args[] = $keysFunction;
            return array_uintersect_uassoc($array, ...$args);
        } elseif ($function && !$keysFunction) {
            $args[] = $function;
            return array_uintersect_assoc($array, ...$args);
        } elseif (!$function && $keysFunction) {
            $args[] = $keysFunction;
            return array_intersect_uassoc($array, ...$args);
        } else {
            return array_intersect_assoc($array, ...$args);
        }
    }

}
