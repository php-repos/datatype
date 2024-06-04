<?php

namespace Tests\Collection\TakeTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return a collection with skipped items',
    case: function () {
        $collection = new Collection(['foo', 'bar', 'baz']);

        assert_true(['foo', 'bar', 'baz'] === $collection->skip(0)->items(), 'Skip with offset 0 is not working!');
        assert_true(['bar', 'baz'] === $collection->skip(1)->items(), 'Skip with offset 1 is not working!');
        assert_true(['baz'] === $collection->skip(2)->items(), 'Skip with offset 2 is not working!');
        assert_true([] === $collection->skip(3)->items(), 'Skip with offset 3 is not working!');
    }
);
