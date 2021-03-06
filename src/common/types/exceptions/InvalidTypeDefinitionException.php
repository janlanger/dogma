<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma;

use function sprintf;

class InvalidTypeDefinitionException extends Exception
{

    public function __construct(string $definition, ?\Throwable $previous = null)
    {
        $example = '\\Tuple<int(64,unsigned),float,\DateTime?>';
        parent::__construct(sprintf(
            'Type definition \'%s\' is invalid. Example of valid complex type definition: \'%s\'.',
            $definition,
            $example
        ), $previous);
    }

}
