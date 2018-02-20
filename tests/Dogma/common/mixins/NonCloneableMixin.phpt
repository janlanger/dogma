<?php declare(strict_types = 1);

namespace Dogma\Tests\NonCloneableMixin;

use Dogma\NonCloneableMixin;
use Dogma\Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class TestClass
{
    use NonCloneableMixin;
}

Assert::throws(function () {
    $x = new TestClass();
    $y = clone($x);
}, \Dogma\NonCloneableObjectException::class);
