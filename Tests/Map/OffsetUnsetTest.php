<?php

namespace Tests\Map\OffsetUnsetTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should check should implement offsetUnset',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));

        $map->offsetUnset(1);

        assert_true([new Pair(1, 'foo')] == $map->items());
    }
);
