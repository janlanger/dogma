<?php

namespace Dogma;

trait StaticClassMixin
{

    /**
     * @throws \Dogma\StaticClassException
     */
    final public function __construct()
    {
        throw new \Dogma\StaticClassException(get_called_class());
    }

}
