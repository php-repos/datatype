<?php

namespace Tests\Map\ValuesTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return values of the map',
    case: function () {
        $map = new Map();
        assert_true([] === $map->values());

        $map->put(new Pair(1, 'foo'));
        assert_true(['foo'] === $map->values());

        $map->put(new Pair('bar', 'baz'));
        assert_true(['foo', 'baz'] === $map->values());
    }
);
