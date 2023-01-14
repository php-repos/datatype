<?php

namespace Tests\Map\EachTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should run the given closure against each items of the map',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));

        $result = [];
        $actual = $map->each(function (Pair $pair, mixed $index) use (&$result) {
            $result[] = $index . $pair->key . $pair->value;
        });

        assert_true($actual instanceof Map);
        assert_true([new Pair(1, 'foo'), new Pair(2, 'bar')] == $actual->items());
        assert_true(['01foo', '12bar'] === $result);
    }
);
