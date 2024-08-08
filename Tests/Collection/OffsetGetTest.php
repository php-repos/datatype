<?php

namespace Tests\Collection\OffsetGetTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should check should implement offsetGet',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        assert_true('foo' === $collection->offsetGet(1));
        assert_true('bar' === $collection->offsetGet(2));
    }
);
