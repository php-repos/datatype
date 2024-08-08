<?php

namespace Tests\Map\FilterTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should filter items by given closure',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put($item2 = new Pair(2, 'bar'));
        $map->put($item3 = new Pair(3, 'baz'));
        $map->put($item4 = new Pair(4, 'qux'));

        $result = $map->filter(function (Pair $pair, $key) {
            return $key === 1 || $pair->value === 'baz' || $pair->key === 4;
        });

        assert_true($result instanceof Map);
        assert_true([1 => $item2, 2 => $item3, 3 => $item4] === $result->items());
    }
);

test(
    title: 'it should filter empty values when closure not passed',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, null));
        $map->put(new Pair(2, ''));
        $map->put(new Pair(3, 0));
        $map->put($item4 = new Pair(4, 'foo'));

        $result = $map->filter();

        assert_true($result instanceof Map);
        assert_true([3 => $item4] === $result->items());
    }
);
