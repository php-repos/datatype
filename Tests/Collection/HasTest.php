<?php

namespace Tests\Collection\HasTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return true if collection has item with the given condition',
    case: function () {
        $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);
        assert_true($collection->has(fn ($item, $key) => $item === 'qux'));
        assert_true($collection->has(fn ($item, $key) => $key === 'baz'));
        assert_false($collection->has(fn ($item, $key) => $key === 0));
        assert_false($collection->has(fn ($item, $key) => $item === null));
    }
);

