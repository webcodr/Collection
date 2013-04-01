<?php

namespace Collection\Habit;

trait MapTrait
{
    /**
     * Returns the first item of attribute array
     *
     * @return mixed
     */

    public function first()
    {
        return reset($this->attributes);
    }

    /**
     * Returns the last item of attribute array
     *
     * @return mixed
     */

    public function last()
    {
        return end($this->attributes);
    }

    /**
     * Reverses the attribute array
     *
     * @return MutableMap
     */

    public function reverse()
    {
        $this->attributes = array_reverse($this->attributes);

        return $this;
    }

    /**
     * Executes given callback function on every attribute array item
     *
     * @param callable $callback
     * @return MutableMap
     * @throws \InvalidArgumentException
     */

    public function each($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Mapping function is not callable!');
        }

        array_walk($this->attributes, $callback);

        return $this;
    }

    /**
     * Executes given mapping function on every attribute array item
     *
     * @param callable $callback
     * @return MutableMap
     * @throws \InvalidArgumentException
     */

    public function map($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Mapping function is not callable!');
        }

        $this->attributes = array_map($callback, $this->attributes);

        return $this;
    }

    /**
     * Returns new MutableList with sliced attribute array
     *
     * @param int $offset
     * @param int $limit
     * @return MutableMap
     */

    public function slice($offset, $limit)
    {
        $attributes = array_slice($this->attributes, $offset, $limit);
        $list = new self();
        $list->assign($attributes);

        return $list;
    }

    /**
     * Returns new MutableList with filtered values from attribute array
     *
     * @param callable $callback
     * @return MutableMap
     * @throws \InvalidArgumentException
     */

    public function filter($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Filter is not callable!');
        }

        $attributes = array_filter($this->attributes, $callback);
        $list = new self();
        $list->assign($attributes);

        return $list;
    }

    /**
     * Joins map elements into a string with a given glue string
     *
     * @param string $glue
     * @return string
     */

    public function join($glue = '')
    {
        return implode($glue, $this->attributes);
    }

    /**
     * Eliminates duplicate values
     *
     * @return MutableMap
     */

    public function unique()
    {
        $this->attributes = array_unique($this->attributes);

        return $this;
    }
}