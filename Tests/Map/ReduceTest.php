<?php

namespace Tests\Map\ReduceTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should reduce items by the given condition',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));

        $result = $map->reduce(fn ($carry, Pair $pair) => $pair->value === 'bar' ? $pair : $carry);

        assert_true(new Pair(2, 'bar') == $result);
    }
);

test(
    title: 'it should pass null as a default carry',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));

        $result = $map->reduce(fn ($carry, Pair $pair) => $pair->value === 'not-exists' ? $pair : $carry);

        assert_true(null === $result);
    }
);

test(
    title: 'it should return carry when the condition returns false for each item',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));
        $map->put(new Pair(3, 'baz'));

        $result = $map->reduce(fn ($carry, Pair $pair) => $pair->value === 'not-exists' ? $pair : $carry, 'this is carry');

        assert_true('this is carry' === $result);
    }
);
