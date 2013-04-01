<?php

namespace Collection\Test;

use Collection\ImmutableMap;

class ImmutableMapTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \BadMethodCallException
     */

    public function testAssign()
    {
        $list = new ImmutableMap();
        $list->assign(array('foo'));
    }

    /**
     * @expectedException \BadMethodCallException
     */

    public function testUpdateProperties()
    {
        $list = new ImmutableMap();
        $list->update(array('foo'));
    }

    /**
     * @expectedException \BadMethodCallException
     */

    public function testSetProperty()
    {
        $list = new ImmutableMap();
        $list->set('foo', 'bar');
    }

    /**
     * @expectedException \BadMethodCallException
     */

    public function testRemoveProperty()
    {
        $list = new ImmutableMap();
        $list->remove('foo');
    }
}