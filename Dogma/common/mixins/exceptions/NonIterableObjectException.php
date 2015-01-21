<?php

namespace Dogma;

final class NonIterableObjectException extends \Dogma\InvalidTypeException
{

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        \Dogma\Exception::__construct(sprintf('Iterating a non-iterable object of class %s.', $class));
    }

}
