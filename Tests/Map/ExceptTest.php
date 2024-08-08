<?php

namespace Tests\Collection\ExceptTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return a new map of items, except items by given closure on a map',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));
        $map->put(new Pair(4, 'qux'));

        $result = $map->except(function (Pair $pair, int $index) {
            return $index === 0 || $pair->key === 2 || $pair->value === 'baz';
        });

        assert_true($result instanceof Map);
        assert_true([
            3 => new Pair(4, 'qux')
            ] == $result->items()
        );
    }
);

test(
    title: 'it should return empty values of a map when closure not passed',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, ''));
        $map->put(new Pair(3, null));
        $map->put(new Pair(4, 'qux'));
        $map->put(new Pair(5, 0));
        $map->put(new Pair(null, 'value'));
        $map->put(new Pair(0, 'string'));

        $result = $map->except();

        assert_true($result instanceof Map);
        assert_true([
            1 => new Pair(2, ''),
            2 => new Pair(3, null),
            4 => new Pair(5, 0),
            ] == $result->items()
        );
    }
);
