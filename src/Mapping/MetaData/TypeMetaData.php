<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Mapping\MetaData;

use Dogma\Check;
use Dogma\Mapping\Type\Handler;
use Dogma\Type;

class TypeMetaData
{
    use \Dogma\StrictBehaviorMixin;

    /** @var \Dogma\Type */
    private $type;

    /** @var \Dogma\Type[] (string $name => $type) */
    private $fields;

    /** @var \Dogma\Mapping\Type\Handler */
    private $handler;

    /**
     * @param \Dogma\Type $type
     * @param \Dogma\Type[] $fields ($name => $type)
     * @param \Dogma\Mapping\Type\Handler $handler
     */
    public function __construct(Type $type, array $fields, Handler $handler)
    {
        Check::itemsOfType($fields, Type::class);

        $this->type = $type;
        $this->fields = $fields;
        $this->handler = $handler;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return \Dogma\Type[] (string $name => $type)
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getHandler(): Handler
    {
        return $this->handler;
    }

}
