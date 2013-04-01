<?php

namespace Collection\Habit;

trait SplTrait
{
    /**
     * Returns count of object attributes
     *
     * @return int
     */

    public function count()
    {
        return count($this->attributes);
    }

    /**
     * Return ArrayIterator instance with list attributes
     *
     * @return \ArrayIterator
     */

    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }
}