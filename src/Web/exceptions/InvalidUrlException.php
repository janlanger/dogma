<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Web;

class InvalidUrlException extends \Dogma\InvalidValueException
{

    public function __construct(string $value, ?\Throwable $previous = null)
    {
        \Dogma\Exception::__construct(sprintf('Invalid URL format: \'%s\'', $value), $previous);
    }

}
