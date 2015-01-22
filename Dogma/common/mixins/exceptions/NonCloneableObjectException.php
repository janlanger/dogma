<?php

namespace Dogma;

final class NonCloneableObjectException extends \Dogma\InvalidTypeException
{

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        \Dogma\Exception::__construct(sprintf('Cloning a non-cloneable object of class %s.', $class));
    }

}
