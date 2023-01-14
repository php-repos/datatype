<?php

namespace Tests\Map\MapClassTest;

use Countable;
use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should construct a map',
    case: function () {
        $items = ['foo' => new Pair(1, 'foo'), 'bar' => new Pair(2, 'bar')];
        $map = new Map($items);

        assert_true($items === $map->items());
    }
);

test(
    title: 'it should make a map',
    case: function () {
        $map = new Map();
        assert_true($map->items() === []);

        $item = new Pair(1, 'foo');
        $map->put($item);
        assert_true($item === $map->items()[0]);
    }
);

test(
    title: 'it should return count of the items',
    case: function () {
        $map = new Map();
        assert_true($map instanceof Countable);

        assert_true(0 === count($map));

        $map->put(new Pair('foo', 'bar'));
        assert_true(1 === count($map));

        $map->put(new Pair('baz', 'qux'));
        assert_true(2 === count($map));
    }
);
