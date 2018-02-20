<?php declare(strict_types = 1);

namespace Dogma\Mapping\Type;

use Dogma\Mapping\Mapper;
use Dogma\Mapping\StaticMappingContainer;
use Dogma\Tester\Assert;
use Dogma\Time\Date;
use Dogma\Type;

require_once __DIR__ . '/../../bootstrap.php';

class TestEnum extends \Dogma\Enum\IntEnum
{

    public const ONE = 1;
    public const TWO = 2;

}

$handler = new EnumHandler();
$mapper = new Mapper(new StaticMappingContainer([]));

$enumType = Type::get(TestEnum::class);

// acceptType()
Assert::true($handler->acceptsType($enumType));
Assert::false($handler->acceptsType(Type::get(Date::class)));

// getParameters()
Assert::equal($handler->getParameters($enumType), null);

// createInstance()
$enumInstance = $handler->createInstance($enumType, 1, $mapper);
Assert::same($enumInstance, TestEnum::get(TestEnum::ONE));

// exportInstance()
Assert::same($handler->exportInstance($enumType, $enumInstance, $mapper), 1);
