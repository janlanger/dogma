<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\BatchCalc;

use Dogma\Arr;
use Dogma\ShouldNotHappenException;
use Dogma\StrictBehaviorMixin;
use Tracy\Dumper;

class BatchCalc
{
	use StrictBehaviorMixin;

	/** @var string[]|mixed[] */
	private $actions;

	public function __construct(array $actions)
	{
		$this->actions = $actions;
	}

	public function calculate(array $inputs): array
	{
		$results = [];
		$dimensions = [];
rd(headers_list());
rd(PHP_SAPI);
		$current = 'A';
		foreach ($this->actions as [$action, $parameters]) {
			if ($action === Action::INPUT_SCALAR) {
				$results[$current] = array_shift($inputs);
				$dimensions[$current] = 0;
				$current++;
				continue;
			} elseif ($action === Action::INPUT_VECTOR) {
				$results[$current] = array_shift($inputs);
				$dimensions[$current] = 1;
				$current++;
				continue;
			}

			$inputDimension = Action::$argumentsDimension[$action];
			$inputNullable = Action::$argumentsNullable[$action];
			$arguments = [];
			$argumentDimensions = [];
			foreach ($parameters as $parameter) {
				if (is_string($parameter) && preg_match('/^\\$[A-Z]+$/', $parameter)) {
					$parameter = substr($parameter, 1);
					$arguments[] = $results[$parameter];
					$dimension = $dimensions[$parameter];
					$argumentDimensions[] = $dimension;
				} else {
					$arguments[] = $parameter;
					$argumentDimensions[] = 0;
				}
			}

			rd($action, 'action');
			[$result, $upscale] = self::call(Action::$actions[$action], $inputDimension, $inputNullable, $arguments, $argumentDimensions, $action);
			rd($result, 'result');
			$results[$current] = $result;
			$dimensions[$current] = Action::$outputDimension[$action] + $upscale;

			$current++;
		}

		return $results;
	}

	/**
	 * @param callable $function
	 * @param int[] $inputDimensions
	 * @param bool[] $inputNullable
	 * @param mixed[] $arguments
	 * @param int[] $argumentDimensions
	 * @return mixed (mixed $result, int $upscale)
	 * @internal
	 */
	public static function call(
		callable $function,
		array $inputDimensions,
		array $inputNullable,
		$arguments,
		array $argumentDimensions
	)
	{
		$diffs = [];
		$counts = [];
		foreach ($inputDimensions as $i => $inputDimension) {
			if ($arguments[$i] === null && !$inputNullable[$i]) {
				return null;
			}
			$diffs[$i] = $argumentDimensions[$i] - $inputDimensions[$i];
			$counts[$i] = $diffs[$i] > 0 ? count($arguments[$i]) : 0;
		}
		$minDiff = min($diffs);
		if ($minDiff < 0) {
			throw new ShouldNotHappenException('Value dimension should be same or higher than argument dimension.');
		}
		$maxDiff = max($diffs);
		$maxCount = max($counts);

		if ($maxDiff > 0) {
			foreach ($diffs as $i => $diff) {
				if ($diff < $maxDiff) {
					$arguments[$i] = array_fill(0, $maxCount, $arguments[$i]);
				} else {
					$argumentDimensions[$i]--;
				}
			}
			$arguments = Arr::transposeSafe($arguments);
			$results = [];
			foreach ($arguments as $itemArguments) {
				[$result, ] = self::call($function, $inputDimensions, $inputNullable, $itemArguments, $argumentDimensions);
				$results[] = $result;
			}
			return [$results, $maxDiff];
		}

		return [$function(...$arguments), 0];
	}

}