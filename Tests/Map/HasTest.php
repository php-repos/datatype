<?php

namespace Tests\Map\HasTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_false;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return true if collection has item with the given condition',
    case: function () {
        $map = new Map();
        $map->put(new Pair('foo', 'bar'));
        $map->put(new Pair('baz', 'qux'));

        assert_true($map->has(fn ($item) => $item->value === 'qux'));
        assert_true($map->has(fn ($item) => $item->key === 'baz'));
        assert_false($map->has(fn ($item) => $item->key === 0));
        assert_false($map->has(fn ($item) => $item->value === null));
    }
);

