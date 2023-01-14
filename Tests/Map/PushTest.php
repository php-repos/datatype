<?php

namespace Tests\Map\PushTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should push the given pair to the map items',
    case: function () {
        $map = new Map();
        $map->push(new Pair(1, 'foo'));

        assert_true([new Pair(1, 'foo')] == $map->items());

        $map->push(new Pair(2, 'bar'));

        assert_true([new Pair(1, 'foo'), new Pair(2, 'bar')] == $map->items());
    }
);

test(
    title: 'it should replace existing key',
    case: function () {
        $map = new Map();
        $map->push(new Pair(1, 'foo'));

        assert_true([new Pair(1, 'foo')] == $map->items());

        $map->push(new Pair(1, 'bar'));

        assert_true([new Pair(1, 'bar')] == $map->items());
    }
);
