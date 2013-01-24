<?php

namespace Collection;

class ImmutableMap extends MutableMap
{

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function assign(array $properties)
    {
        throw new \BadMethodCallException('Method "assign" is not supported by class ImmutableList.');
    }

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function updateProperties($properties)
    {
        throw new \BadMethodCallException('Method "updateProperties" is not supported by class ImmutableList.');
    }

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function setProperty($property, $value)
    {
        throw new \BadMethodCallException('Method "setProperty" is not supported by class ImmutableList.');
    }

    /**
     * Unsupported method
     *
     * @throws \BadMethodCallException
     */

    public function removeProperty($property)
    {
        throw new \BadMethodCallException('Method "removeProperty" is not supported by class ImmutableList.');
    }
}
