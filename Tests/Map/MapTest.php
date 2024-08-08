<?php

namespace Tests\Map\MapTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return empty array as map when there is no item in the map',
    case: function () {
        $map = new Map();

        assert_true([] === $map->map(fn (Pair $pair) => $pair->key.$pair->value));
    }
);

test(
    title: 'it should map a map items by return value of the given callable',
    case: function () {
        $map = new Map();

        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'), 'baz');

        assert_true(['01foo', 'baz2bar'] === $map->map(fn (Pair $pair, mixed $index) => $index.$pair->key.$pair->value));
    }
);
