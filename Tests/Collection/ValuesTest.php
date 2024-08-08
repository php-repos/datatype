<?php

namespace Tests\Collection\ValuesTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should run collection values',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        assert_true(['foo', 'bar'] === $collection->values());
    }
);
