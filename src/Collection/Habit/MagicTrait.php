<?php

namespace Collection\Habit;

trait MagicTrait
{
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
        return $this->has($attribute);
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
}