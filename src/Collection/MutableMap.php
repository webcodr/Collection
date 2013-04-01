<?php

namespace Collection;

class MutableMap implements \Countable, \IteratorAggregate
{

    /**
     * Stores attributes
     * @var array
     */

    protected $attributes = array();

    /**
     * Constructor
     *
     * Accepts any arguments and saves them as attributes
     *
     * @param mixed [...]
     */

    public function __construct()
    {
        $args = func_get_args();

        if (!empty($args)) {
            if (is_array($args[0])) {
                $this->assign($args[0]);
            } else {
                $this->attributes = $args;
            }
        }
    }

    /**
     * Magic method __get()
     *
     * Gets a attribute from attribute array
     *
     * @param string $attribute
     * @return mixed
     */

    public function __get($attribute)
    {
        if ($attribute === 'length') {
            return $this->count();
        }

        return $this->get($attribute);
    }

    /**
     * Magic method __set()
     *
     * Sets a attribute to attribute array
     *
     * @param string $attribute attribute name
     * @param mixed $value attribute value
     */

    public function __set($attribute, $value)
    {
        $this->set($attribute, $value);
    }

    /**
     * Magic method __isset()
     *
     * Checks if a attribute exists in attribute array
     *
     * @param string $attribute
     * @return bool
     */

    public function __isset($attribute)
    {
        return isset($this->attributes[$attribute]);
    }

    /**
     * Magic method __unset()
     *
     * Removes a attribute from attribute array
     *
     * @param string $attribute
     */

    public function __unset($attribute)
    {
        $this->remove($attribute);
    }

    /**
     * Magic method __toString
     *
     * Serializes attribute array and returns the string
     *
     * @return string
     */

    public function __toString()
    {
        return serialize($this->attributes);
    }

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
     * Imports an array
     *
     * @param array $attributes
     * @return MutableMap
     */

    public function assign(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Update attributes with from given array
     *
     * @param array $attributes
     * @return MutableMap
     */

    public function update($attributes)
    {
        if (!empty($attributes)) {
            foreach ($attributes as $attribute => $value) {
                $this->set($attribute, $value);
            }
        }

        return $this;
    }

    /**
     * Returns value of given attribute name or throws an exception if the attribute does not exist
     *
     * @param $attribute
     * @param bool $arrayAsMap
     * @return MutableMap
     * @throws \OutOfBoundsException
     */

    public function get($attribute, $arrayAsMap = true)
    {
        if (array_key_exists($attribute, $this->attributes)) {
            $value = $this->attributes[$attribute];

            if ($arrayAsMap === true && is_array($value)) {
                $value = new MutableMap($value);
            }

            return $value;
        }

        throw new \OutOfBoundsException("Attribute '{$attribute}' does not exist");
    }

    /**
     * Sets a attribute and its value
     *
     * @param string $attribute
     * @param mixed $value
     * @return MutableMap
     */

    public function set($attribute, $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Removes a attribute
     *
     * @param $attribute
     * @return $this
     * @throws \OutOfBoundsException
     */

    public function remove($attribute)
    {
        if (!array_key_exists($attribute, $this->attributes)) {
            throw new \OutOfBoundsException("Attribute '{$attribute}' does not exist");
        }

        unset($this->attributes[$attribute]);

        return $this;
    }

    /**
     * Returns all attributes as new MutableList
     *
     * @return array
     */

    public function all()
    {
        // get all attribute names
        $attributes = array_keys($this->attributes);
        $list = new MutableMap();

        if (!empty($attributes)) {
            foreach ($attributes as $attribute) {
                $list->set($attribute, $this->get($attribute));
            }
        }

        return $list;
    }

    /**
     * Returns all attributes as new MutableList
     *
     * @return array
     */

    public function getArray()
    {
        // get all attribute names
        $attributes = array_keys($this->attributes);
        $values = array();

        if (!empty($attributes)) {
            foreach ($attributes as $attribute) {
                $values[$attribute] = $this->get($attribute, false);
            }
        }

        return $values;
    }

    /******************/
    /* SPL interfaces */
    /******************/

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