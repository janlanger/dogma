<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Mapping;

use Dogma\Type;

class DynamicMappingContainer implements \Dogma\Mapping\MappingContainer
{
    use \Dogma\StrictBehaviorMixin;

    /** @var \Dogma\Mapping\MappingBuilder */
    private $mappingBuilder;

    /** @var \Dogma\Mapping\Mapping[] (string $typeId => $mapping) */
    private $mappings = [];

    public function __construct(MappingBuilder $mappingBuilder)
    {
        $this->mappingBuilder = $mappingBuilder;
    }

    public function getMapping(Type $type): Mapping
    {
        $typeId = $type->getId();
        if (!isset($this->mappings[$typeId])) {
            $this->mappings[$typeId] = $this->mappingBuilder->buildMapping($type);
        }
        return $this->mappings[$typeId];
    }

}
