<?php

namespace Tests\Collection\ItemsTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should run collection items',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        assert_true([1 => 'foo', 2 => 'bar'] === $collection->items());
    }
);
