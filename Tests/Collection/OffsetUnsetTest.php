<?php

namespace Tests\Collection\OffsetUnsetTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should check should implement offsetUnset',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        $collection->offsetUnset(2);

        assert_true([1 => 'foo'] === $collection->items());
    }
);
