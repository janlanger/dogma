<?php
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Reflection;

class InvalidMethodAnnotationException extends \Dogma\Exception implements \Dogma\Reflection\Exception
{

    /**
     * @param string $method
     * @param string $message
     * @param \Exception $previous
     */
    public function __construct(\ReflectionMethod $method, string $message, ?\Exception $previous = null)
    {
        parent::__construct(sprintf(
            'Invalid method annotation on %s::%s: %s',
            $method->getDeclaringClass()->getName(),
            $method->getName(),
            $message
        ), $previous);
    }

}