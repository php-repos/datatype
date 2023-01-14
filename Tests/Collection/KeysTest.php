<?php

namespace Tests\Collection\KeysTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should run collection keys',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        assert_true([1, 2] === $collection->keys());
    }
);
