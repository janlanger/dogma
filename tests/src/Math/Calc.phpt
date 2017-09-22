<?php

namespace Dogma\Tests\Math;

use Dogma\Math\Calc;
use Dogma\Math\Fraction;
use Dogma\Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


// factorize()
Assert::same(Calc::factorize(1), []);
Assert::same(Calc::factorize(2), [2]);
Assert::same(Calc::factorize(3), [3]);
Assert::same(Calc::factorize(4), [2, 2]);
Assert::same(Calc::factorize(8), [2, 2, 2]);
Assert::same(Calc::factorize(60), [2, 2, 3, 5]);
Assert::same(Calc::factorize(720), [2, 2, 2, 2, 3, 3, 5]);

// greatestCommonDivider()
Assert::same(Calc::greatestCommonDivider(1, 1), 1);
Assert::same(Calc::greatestCommonDivider(1, 2), 1);
Assert::same(Calc::greatestCommonDivider(2, 2), 2);
Assert::same(Calc::greatestCommonDivider(2, 3), 1);
Assert::same(Calc::greatestCommonDivider(4, 6), 2);
Assert::same(Calc::greatestCommonDivider(84, 140), 28);

// leastCommonMultiple()
Assert::same(Calc::leastCommonMultiple(1, 1), 1);
Assert::same(Calc::leastCommonMultiple(1, 2), 2);
Assert::same(Calc::leastCommonMultiple(2, 2), 2);
Assert::same(Calc::leastCommonMultiple(2, 3), 6);
Assert::same(Calc::leastCommonMultiple(4, 6), 12);
Assert::same(Calc::leastCommonMultiple(14, 15), 210);

// simplify()
Assert::equal(Calc::simplify(new Fraction(15, 60)), new Fraction(1, 4));
Assert::equal(Calc::simplify(new Fraction(84, 140)), new Fraction(3, 5));
