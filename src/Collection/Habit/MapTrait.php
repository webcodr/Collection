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

    /**
     * Sorts alphabetically or using the given callback
     *
     * @param null $callback
     * @return $this
     */

    public function sort($callback = null)
    {
        if (is_callable($callback)) {
            usort($this->attributes, $callback);
        } else {
            sort($this->attributes);
        }

        return $this;
    }

    /**
     * Shifts an element off the beginning of array
     *
     * @return mixed
     */

    public function shift()
    {
        return array_shift($this->attributes);
    }

    /**
     * Pops the element off the end of array
     *
     * @return mixed
     */

    public function pop()
    {
        return array_pop($this->attributes);
    }

    /**
     * Prepends one or more elements to the beginning of an array
     *
     * @return $this
     */

    public function unshift()
    {
        $args = func_get_args();

        if (!empty($args)) {
            foreach ($args as  $arg) {
                array_unshift($this->attributes, $arg);
            }
        }

        return $this;
    }

    /**
     * Pushes one or more elements onto the end of array
     *
     * @return $this
     */

    public function push()
    {
        $args = func_get_args();

        if (!empty($args)) {
            foreach ($args as  $arg) {
                array_push($this->attributes, $arg);
            }
        }

        return $this;
    }
}