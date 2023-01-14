<?php

namespace Tests\Map\OffsetSetTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should check should implement offsetSet',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));

        $map->offsetSet(4, new Pair(3, 'baz'));

        assert_true([
            0 => new Pair(1 , 'foo'),
            1 => new Pair(2, 'bar'),
            4 => new Pair(3, 'baz')
        ] == $map->items());
    }
);
