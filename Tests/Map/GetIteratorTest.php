<?php

namespace Tests\Map\GetIteratorTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should implement getIterator',
    case: function () {
        $map = new Map();
        $map->put(new Pair('foo', 'bar'));
        $map->put(new Pair('baz', 'qux'));

        $actual = [];
        foreach ($map as $key => $value) {
            $actual[$key] = $value;
        }

        assert_true($actual == [new Pair('foo', 'bar'), new Pair('baz', 'qux')]);
    }
);
