<?php

namespace Collection\Test;

use Collection\ArrayMap;

class ArrayMapTest extends \PHPUnit_Framework_TestCase
{

    public function testArrayAccess()
    {
        $list = new ArrayMap();
        $property = 'foo';
        $value = 'bar';
        $array = array('foo' => 'bar');
        $list[$property] = $value;

        $this->assertEquals($array[$property], $list[$property]);
    }

    public function testArrayAccessExists()
    {
        $list = new ArrayMap();
        $this->assertFalse(isset($list['foo']));
    }

    public function testArrayAccessUnset()
    {
        $list = new ArrayMap();
        $list['foo'] = 'bar';
        unset($list['foo']);

        $this->assertFalse(isset($list['foo']));
    }
}