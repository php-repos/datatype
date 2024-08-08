<?php

namespace Tests\Map\TakeTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return pair value of the map where item passes the given condition and remove it from the map',
    case: function () {
        $map = new Map();
        $map->push($item1 = new Pair(1, 'foo'));
        $map->push($item2 = new Pair(2, 'bar'));
        $map->push($item3 = new Pair(3, 'baz'));

        $result = $map->take(fn (Pair $pair) => $pair->value === 'bar');

        assert_true($item2 === $result);
        assert_true([0 => $item1, 2 => $item3] === $map->items());
    }
);

test(
    title: 'it should keep the map intact when condition does not meet for any item',
    case: function () {
        $map = new Map();
        $map->push($item1 = new Pair(1, 'foo'));
        $map->push($item2 = new Pair(2, 'bar'));
        $map->push($item3 = new Pair(3, 'baz'));

        $result = $map->take(fn (Pair $pair) => $pair->value === 'qux');

        assert_true(null === $result);
        assert_true([0 => $item1, 1 => $item2, 2 => $item3] === $map->items());
    }
);
