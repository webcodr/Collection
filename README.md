# Collection

[![Build Status](https://travis-ci.org/WebCodr/Collection.png?branch=master)](https://travis-ci.org/WebCodr/Collection)

### A set of array replacement classes for PHP

### Requirements

- PHP 5.4
- Composer

### Setup

#### Add Collection to your project

~~~ bash
$ php composer.phar require webcodr/collection:2.*
~~~

### Basic information

Collections provides two classes: MutableMap and ArrayMap

ArrayMap extends MutableMap with in an implementation of the SPL interface ArrayAccess

MutableMap implements the SPL interfaces IteratorAggregate and Countable.

Both classes support a fluent interface with method chaining. Methods without a specific return value like `get()` or `has()` will return in the object itself.

### Usage

A little code example says more than 1,000 words, so here we go:

~~~ php
<?php

use Collection\MutableMap;

$map = new MutableMap([
    'name' => 'William Adama',
    'rank' => 'Admiral'
]);

// getter and setter methods
echo $map->get('name'); // result = William Adama
var_dump($map->has('name')); // result = true

$map->set('commands', 'BSG 75');

// iterator method (you also use foreach() on the $map object)
$map->each(function($value, $attribute) {
    echo "{$attribute}: {$value}";
});

// update attributes with an array
$map->update([
    'name' => 'Lee Adama',
    'rank' => 'Commander',
    'commands' => 'BSG 62'
]);

echo $map->get('name'); // result = Lee Adama

// fast access with first() and last()
$battlestars = new MutableMap('Galactica', 'Pegasus', 'Atlantia');
echo $battlestars->first(); // result = Galactica
echo $battlestars->last(); // result = Atlantia

// method chaining
echo $battlestars->reverse()->last(); // result = Galactica
~~~


