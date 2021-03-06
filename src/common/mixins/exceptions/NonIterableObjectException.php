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

final class NonIterableObjectException extends Exception
{

    public function __construct(string $class, ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('Iterating a non-iterable object of class %s.', $class), $previous);
    }

}
