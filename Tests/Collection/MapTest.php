<?php

namespace Tests\Collection\MapTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should map items to the given closure',
    case: function () {
        $collection = new Collection(['foo', 'bar', 'baz']);

        assert_true(['0foo', '1bar', '2baz'] === $collection->map(fn ($item, $key) => $key.$item));
    }
);
