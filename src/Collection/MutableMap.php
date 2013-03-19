<?php

namespace Collection;

class MutableMap implements \Countable, \IteratorAggregate
{

    /**
     * Stores properties
     * @var array
     */

    protected $properties = array();

    /**
     * Constructor
     *
     * Accepts any arguments and saves them as properties
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
                $this->properties = $args;
            }
        }
    }

    /**
     * Magic method __get()
     *
     * Gets a property from property array
     *
     * @param string $property
     * @return mixed
     */

    public function __get($property)
    {
        if ($property === 'length') {
            return $this->count();
        }

        return $this->getProperty($property);
    }

    /**
     * Magic method __set()
     *
     * Sets a property to property array
     *
     * @param string $property property name
     * @param mixed $value property value
     */

    public function __set($property, $value)
    {
        $this->setProperty($property, $value);
    }

    /**
     * Magic method __isset()
     *
     * Checks if a property exists in property array
     *
     * @param string $property
     * @return bool
     */

    public function __isset($property)
    {
        return isset($this->properties[$property]);
    }

    /**
     * Magic method __unset()
     *
     * Removes a property from property array
     *
     * @param string $property
     */

    public function __unset($property)
    {
        $this->removeProperty($property);
    }

    /**
     * Magic method __toString
     *
     * Serializes property array and returns the string
     *
     * @return string
     */

    public function __toString()
    {
        return serialize($this->properties);
    }

    /**
     * Returns the first item of property array
     *
     * @return mixed
     */

    public function head()
    {
        return reset($this->properties);
    }

    /**
     * Returns the last item of property array
     *
     * @return mixed
     */

    public function last()
    {
        return end($this->properties);
    }

    /**
     * Reverses the property array
     *
     * @return MutableMap
     */

    public function reverse()
    {
        $this->properties = array_reverse($this->properties);

        return $this;
    }

    /**
     * Executes given callback function on every property array item
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

        array_walk($this->properties, $callback);

        return $this;
    }

    /**
     * Executes given mapping function on every property array item
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

        $this->properties = array_map($callback, $this->properties);

        return $this;
    }

    /**
     * Returns new MutableList with sliced property array
     *
     * @param int $offset
     * @param int $limit
     * @return MutableMap
     */

    public function slice($offset, $limit)
    {
        $properties = array_slice($this->properties, $offset, $limit);
        $list = new self();
        $list->assign($properties);

        return $list;
    }

    /**
     * Returns new MutableList with filtered values from property array
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

        $properties = array_filter($this->properties, $callback);
        $list = new self();
        $list->assign($properties);

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
        return implode($glue, $this->properties);
    }

    /**
     * Eliminates duplicate values
     *
     * @return MutableMap
     */

    public function unique()
    {
        $this->properties = array_unique($this->properties);

        return $this;
    }

    /**
     * Imports an array
     *
     * @param array $properties
     * @return MutableMap
     */

    public function assign(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Update properties with from given array
     *
     * @param array $properties
     * @return MutableMap
     */

    public function updateProperties($properties)
    {
        if (!empty($properties)) {
            foreach ($properties as $property => $value) {
                $this->setProperty($property, $value);
            }
        }

        return $this;
    }

    /**
     * Returns value of given property name or throws an exception if the property does not exist
     *
     * @param $property
     * @param bool $arrayAsMap
     * @return MutableMap
     * @throws \OutOfBoundsException
     */

    public function getProperty($property, $arrayAsMap = true)
    {
        if (array_key_exists($property, $this->properties)) {
            $value = $this->properties[$property];

            if ($arrayAsMap === true && is_array($value)) {
                $value = new MutableMap($value);
            }

            return $value;
        }

        throw new \OutOfBoundsException("Index '{$property}' does not exist");
    }

    /**
     * Sets a property and its value
     *
     * @param string $property
     * @param mixed $value
     * @return MutableMap
     */

    public function setProperty($property, $value)
    {
        $this->properties[$property] = $value;

        return $this;
    }

    /**
     * Removes a property
     *
     * @param $property
     * @return $this
     * @throws \OutOfBoundsException
     */

    public function removeProperty($property)
    {
        if (!array_key_exists($property, $this->properties)) {
            throw new \OutOfBoundsException("Index '{$property}' does not exist");
        }

        unset($this->properties[$property]);

        return $this;
    }

    /**
     * Returns all properties as new MutableList
     *
     * @return array
     */

    public function getProperties()
    {
        // get all property names
        $properties = array_keys($this->properties);
        $list = new MutableMap();

        if (!empty($properties)) {
            foreach ($properties as $property) {
                $list->setProperty($property, $this->getProperty($property));
            }
        }

        return $list;
    }

    /**
     * Returns all properties as new MutableList
     *
     * @return array
     */

    public function getArray()
    {
        // get all property names
        $properties = array_keys($this->properties);
        $values = array();

        if (!empty($properties)) {
            foreach ($properties as $property) {
                $values[$property] = $this->getProperty($property, false);
            }
        }

        return $values;
    }

    /******************/
    /* SPL interfaces */
    /******************/

    /**
     * Returns count of object properties
     *
     * @return int
     */

    public function count()
    {
        return count($this->properties);
    }

    /**
     * Return ArrayIterator instance with list properties
     *
     * @return \ArrayIterator
     */

    public function getIterator()
    {
        return new \ArrayIterator($this->properties);
    }
}