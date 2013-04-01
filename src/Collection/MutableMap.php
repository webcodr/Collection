<?php

namespace Collection;

class MutableMap implements \Countable, \IteratorAggregate
{
    use Habit\AttributeTrait;
    use Habit\MapTrait;
    use Habit\MagicTrait;
    use Habit\SplTrait;
}