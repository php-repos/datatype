<?php

namespace Tests\Map\FirstKeyTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return first key that pass the given condition',
    case: function () {
        $map = new Map();
        $map->push(new Pair(1, 'foo'));
        $map->push(new Pair(2, 'bar'));
        $map->push(new Pair(3, 'baz'));

        assert_true(2 === $map->first_key(fn (Pair $pair) => $pair->value === 'bar'));
    }
);

test(
    title: 'it should return first key of the map when the condition does not pass',
    case: function () {
        $map = new Map();
        $map->push(new Pair(1, 'foo'));
        $map->push(new Pair(2, 'bar'));
        $map->push(new Pair(3, 'baz'));

        assert_true(1 === $map->first_key());
    }
);
