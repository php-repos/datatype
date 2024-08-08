<?php

namespace Tests\Map\SkipTest;

use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return a map with skipped items',
    case: function () {
        $map = new Map();
        $map->push($item1 = new Pair(1, 'foo'));
        $map->push($item2 = new Pair(2, 'bar'));
        $map->push($item3 = new Pair(3, 'baz'));

        assert_true([0 => $item1, 1 => $item2, 2 => $item3] === $map->skip(0)->items(), 'Offset 0 is not working!');
        assert_true([0 => $item2, 1 => $item3] === $map->skip(1)->items(), 'Offset 1 is not working!');
        assert_true([0 => $item3] === $map->skip(2)->items(), 'Offset 2 is not working!');
        assert_true([] === $map->skip(3)->items(), 'Offset 3 is not working!');
    }
);
