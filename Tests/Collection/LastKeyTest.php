<?php

namespace Tests\Collection\LastKeyTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should last key item of the collection',
    case: function () {
        $collection = new Collection(['foo', 'baz']);
        assert_true(1 === $collection->last_key(), 'list key is not working');
    }
);

test(
    title: 'it should return any type as the last key item',
    case: function () {
        $collection = new Collection(['foo' => 'bar', null => 'foo']);
        assert_true('' === $collection->last_key(), 'null key is not working');

        $collection = new Collection(['foo' => 'baz', 1 => 'bar']);
        assert_true(1 === $collection->last_key(), 'number key is not working');

        $collection = new Collection(['bar' => 'baz', 'foo' => ['bar']]);
        assert_true('foo' === $collection->last_key(), 'string key is not working');
    }
);

test(
    title: 'it should return null when the given collection is empty',
    case: function () {
        $collection = new Collection([]);
        assert_true(null === $collection->last_key(), 'key for empty collection is not working');
    }
);

test(
    title: 'it should return the last key one that meets the condition',
    case: function () {
        $collection = new Collection(['foo' => 1, 'bar' => 2, 'baz' => 2]);
        assert_true('baz' === $collection->last_key(fn ($item) => $item === 2), 'key with closure is not working');
    }
);
