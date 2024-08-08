<?php

namespace Tests\Collection\PutTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should put items to the collection',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);
        $collection->put('baz', 3);

        assert_true([1 => 'foo', 2 => 'bar', 3 => 'baz'] === $collection->items());
    }
);

test(
    title: 'it should put items to the collection by natural key when it is not passed',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);
        $collection->put('baz');

        assert_true([1 => 'foo', 2 => 'bar', 'baz'] === $collection->items());
    }
);
