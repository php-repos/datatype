<?php

namespace Tests\Map\FirstTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return the first item of the map',
    case: function () {
        $map = new Map();
        assert_true(null === $map->first());

        $map->put(new Pair(1, 'foo'));
        assert_true(1 === $map->first()->key);
        assert_true('foo' === $map->first()->value);

        $map->put(new Pair(1, 'bar'));
        assert_true(1 === $map->first()->key);
        assert_true('bar' === $map->first()->value);

        $map->put(new Pair(2, 'baz'));
        assert_true(1 === $map->first()->key);
        assert_true('bar' === $map->first()->value);
        assert_true(2 === $map->last()->key);
        assert_true('baz' === $map->last()->value);
    }
);

test(
    title: 'it should return the first item of the map that satisfies the given closure',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));

        $result = $map->first(fn (Pair $pair) => str_starts_with($pair->value, 'b'));

        assert_true(2 === $result->key);
        assert_true('bar' === $result->value);
    }
);
