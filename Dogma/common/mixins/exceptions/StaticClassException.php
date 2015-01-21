<?php

namespace Dogma;

class StaticClassException extends \Dogma\InvalidTypeException
{

    /**
     * @param string
     */
    public function __construct($class)
    {
        \Dogma\Exception::__construct(sprintf('Cannot instanciate a static class %s.', $class));
    }

}
