<?php declare(strict_types = 1);

namespace Dogma\Tests\Math\Interval;

use Dogma\Math\BatchCalc\Action;
use Dogma\Math\BatchCalc\BatchCalc;
use Dogma\Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

$multiply = function (int $x, int $y): int {
	return $x * $y;
};

// 0 x 0 -> 0 x 0
Assert::same(BatchCalc::call($multiply, [0, 0], [false, false], [2, 3], [0, 0]), [6, 0]);
// 1 x 0 -> 0 x 0
Assert::same(BatchCalc::call($multiply, [0, 0], [false, false], [[2, 3], 3], [1, 0]), [[6, 9], 1]);
// 1 x 1 -> 0 x 0
Assert::same(BatchCalc::call($multiply, [0, 0], [false, false], [[2, 3], [3, 5]], [1, 1]), [[6, 15], 1]);
// 2 x 0 -> 0 x 0
Assert::same(BatchCalc::call($multiply, [0, 0], [false, false], [[[2, 3], [4, 5]], 3], [2, 0]), [[[6, 9], [12, 15]], 2]);
// 2 x 1 -> 0 x 0
Assert::same(BatchCalc::call($multiply, [0, 0], [false, false], [[[2, 3], [4, 5]], [3, 5]], [2, 1]), [[[6, 15], [12, 25]], 2]);

$multiply = function (array $xs, int $y): array {
	return array_map(function ($x) use ($y) { return $x * $y; }, $xs);
};

// 1 x 0 -> 1 x 0
Assert::same(BatchCalc::call($multiply, [1, 0], [false, false], [[2, 3], 3], [1, 0]), [[6, 9], 0]);
// 1 x 1 -> 1 x 0
Assert::same(BatchCalc::call($multiply, [1, 0], [false, false], [[2, 3], [3, 5]], [1, 1]), [[[6, 9], [10, 15]], 1]);
// 2 x 0 -> 1 x 0
Assert::same(BatchCalc::call($multiply, [1, 0], [false, false], [[[2, 3], [4, 5]], 3], [2, 0]), [[[6, 9], [12, 15]], 1]);
// 2 x 1 -> 1 x 0
Assert::same(BatchCalc::call($multiply, [1, 0], [false, false], [[[2, 3], [4, 5]], [3, 5]], [2, 1]), [[[6, 9], [20, 25]], 1]);


Action::initActions();

$calc = new BatchCalc([
	[Action::INPUT_SCALAR, []], // A
	[Action::SPLIT, ['$A', ' ']], // B
	[Action::FROM_BINARY, ['$B']], // C
	[Action::FACTORIZE, ['$C']], // D
	[Action::PRIME_POS, ['$D']], // E
	[Action::DECREMENT, ['$E']], // F
	[Action::POWER, [2, '$F']], // G
	[Action::SUM, ['$G']], // H
	[Action::TO_LETTER, ['$H']], // I
	[Action::JOIN, ['$I', null]], // J
]);
$input = '1011 11010010 1000110 1101001 1110 101010 1101001 10 10100101 10011010 1000010 1010 111 100001 10 101 1010';
$results = $calc->calculate([$input]);
Assert::same($results['J'], 'POMNIKNAVYSEHRADE');
