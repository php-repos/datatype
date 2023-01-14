<?php

namespace Tests\Collection\OffsetExistsTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_false;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should implement offsetExists',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        assert_true($collection->offsetExists(1));
        assert_false($collection->offsetExists(3));
    }
);
