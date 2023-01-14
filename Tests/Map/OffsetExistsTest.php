<?php

namespace Tests\Map\OffsetExistsTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_false;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should implement offsetExists',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(2, 'bar'));

        assert_true($map->offsetExists(0));
        assert_true($map->offsetExists(1));
        assert_false($map->offsetExists(2));
    }
);
