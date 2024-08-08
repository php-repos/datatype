<?php

namespace Tests\Collection\PushTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should push the given item to the collection',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);
        $collection->push('baz');

        assert_true([1 => 'foo', 2 => 'bar', 'baz'] === $collection->items());
    }
);
