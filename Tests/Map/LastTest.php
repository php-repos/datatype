<?php

namespace Tests\Map\LastTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return the last item of the map',
    case: function () {
        $map = new Map();
        assert_true(null === $map->last());

        $map->put(new Pair(1, 'foo'));
        assert_true(1 === $map->last()->key);
        assert_true('foo' === $map->last()->value);

        $map->put(new Pair(1, 'bar'));
        assert_true(1 === $map->last()->key);
        assert_true('bar' === $map->last()->value);

        $map->put(new Pair(2, 'baz'));
        assert_true(1 === $map->first()->key);
        assert_true('bar' === $map->first()->value);
        assert_true(2 === $map->last()->key);
        assert_true('baz' === $map->last()->value);
    }
);

test(
    title: 'it should return the last item of the map that satisfies the given closure',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));

        $result = $map->last(fn (Pair $pair) => str_starts_with($pair->value, 'b'));

        assert_true(3 === $result->key);
        assert_true('baz' === $result->value);
    }
);
