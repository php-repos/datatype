<?php

namespace Tests\Map\KeysTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return keys of the map',
    case: function () {
        $map = new Map();
        assert_true([] === $map->keys());

        $map->put(new Pair(1, 'foo'));
        assert_true([1] === $map->keys());

        $map->put(new Pair('bar', 'baz'));
        assert_true([1, 'bar'] === $map->keys());
    }
);
