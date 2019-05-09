<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\Alphabet;

use Dogma\Exception;
use Throwable;

class UndefinedCodeException extends Exception
{

    public function __construct(string $code, string $alphabet, ?Throwable $previous = null)
    {
        parent::__construct(sprintf('Code "%s" is not implemented in %s alphabet.', $code, end(explode('\\', $alphabet))));
    }

}
