<?php

namespace Collection;

class ImmutableMap extends MutableMap
{

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function assign(array $attributes)
    {
        throw new \BadMethodCallException('Method "assign" is not supported by class ImmutableList.');
    }

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function update($attributes)
    {
        throw new \BadMethodCallException('Method "updateProperties" is not supported by class ImmutableList.');
    }

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function set($attribute, $value)
    {
        throw new \BadMethodCallException('Method "setProperty" is not supported by class ImmutableList.');
    }

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function remove($attribute)
    {
        throw new \BadMethodCallException('Method "removeProperty" is not supported by class ImmutableList.');
    }
}
