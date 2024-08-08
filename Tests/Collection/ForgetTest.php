<?php

namespace Tests\Collection\ForgetTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should forget items from the collection by given condition',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar', 3 => 'baz']);
        $collection->forget(fn ($item, $key) => $item === 'foo' || $key === 2);

        assert_true([3 => 'baz'] === $collection->items());
    }
);

test(
    title: 'it should do nothing when the check returns null for items',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);
        $collection->forget(fn ($item, $key) => $item === 'hello worlds');

        assert_true([1 => 'foo', 2 => 'bar'] === $collection->items());
    }
);
