<?php

namespace Tests\Collection\FirstKeyTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should first key item of the collection',
    case: function () {
        $collection = new Collection(['foo', 'baz']);

        assert_true(0 === $collection->first_key(), 'list key is not working');
    }
);

test(
    title: 'it should return any type as the first key item',
    case: function () {
        $collection = new Collection([null => 'foo', 'foo' => 'bar']);
        assert_true('' === $collection->first_key(), 'null key is not working');

        $collection = new Collection([1 => 'bar', 'foo' => 'baz']);
        assert_true(1 === $collection->first_key(), 'number key is not working');

        $collection = new Collection(['foo' => ['bar'], 'bar' => 'baz']);
        assert_true('foo' === $collection->first_key(), 'string key is not working');
    }
);

test(
    title: 'it should return null when the given collection is empty',
    case: function () {
        $collection = new Collection([]);
        assert_true(null === $collection->first_key(), 'key for empty collection is not working');
    }
);

test(
    title: 'it should return the first key one that meets the condition',
    case: function () {
        $collection = new Collection(['foo' => 1, 'bar' => 2, 'baz' => 2]);
        assert_true('bar' === $collection->first_key(fn ($item) => $item === 2), 'key with closure is not working');
    }
);
