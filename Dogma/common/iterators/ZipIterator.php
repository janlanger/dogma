<?php

namespace Dogma;

use IteratorAggregate;

class ZipIterator implements \Iterator
{
    use \Dogma\StrictBehaviorMixin;

    /** @var \Iterator */
    private $keys;

    /** @var \Iterator */
    private $values;

    /**
     * @param mixed[]|\Traversable $keys
     * @param mixed[]|\Traversable $values
     */
    public function __construct($keys, $values)
    {
        Check::traversable($keys);
        Check::traversable($values);

        $this->keys = is_array($keys)
            ? new ArrayIterator($keys)
            : ($keys instanceof IteratorAggregate ? $keys->getIterator() : $keys);

        $this->values = is_array($values)
            ? new ArrayIterator($values)
            : ($values instanceof IteratorAggregate ? $values->getIterator() : $values);
    }

    public function rewind()
    {
        $this->keys->rewind();
        $this->values->rewind();
    }

    public function next()
    {
        $this->keys->next();
        $this->values->next();
    }

    public function valid(): bool
    {
        return $this->keys->valid() && $this->values->valid();
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        return $this->values->valid() ? $this->values->current() : null;
    }

    /**
     * @return int|string|null
     */
    public function key()
    {
        return $this->keys->valid() ? $this->keys->current() : null;
    }

}
