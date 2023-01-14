<?php

namespace Tests\Map\EveryTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_false;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it returns true when the map is empty',
    case: function () {
        $map = new Map();
        assert_true($map->every());
    }
);

test(
    title: 'it return true when every item has value',
    case: function () {
        $map = new Map();
        $map->push(new Pair(1, 'foo'))
            ->push(new Pair(2, 'bar'))
            ->push(new Pair(3, 'baz'));
        assert_true($map->every());
    }
);

test(
    title: 'it return false when items are empty',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, null));
        assert_false($map->every());

        $map->put(new Pair(2, 0));
        assert_false($map->every());

        $map->put(new Pair(3, ''));
        assert_false($map->every());
    }
);

test(
    title: 'it should return true when every item passes the check',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));
        assert_true($map->every(fn (Pair $item) => is_string($item->value)));
        assert_true($map->every(fn (Pair $item) => is_numeric($item->key)));
        assert_false($map->every(fn (Pair $item) => is_null($item)));
    }
);
