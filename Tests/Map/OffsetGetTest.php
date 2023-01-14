<?php

namespace Tests\Map\OffsetGetTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should check should implement offsetGet',
    case: function () {
        $map = new Map();
        $map->put($item1 = new Pair(1, 'foo'));
        $map->put($item2 = new Pair(2, 'bar'));

        assert_true($item1 === $map->offsetGet(0));
        assert_true($item2 === $map->offsetGet(1));
    }
);
