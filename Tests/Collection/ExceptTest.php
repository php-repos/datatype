<?php

namespace Tests\Collection\EachTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return except items by given closure',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar', 3 => 'baz', 4 => 'qux']);

        $result = $collection->except(function ($value, $key) {
            return $key === 2 || $value === 'baz';
        });

        assert_true($result instanceof Collection);
        assert_true([1 => 'foo', 4 => 'qux'] === $result->items());
    }
);

test(
    title: 'it should return empty values when closure not passed',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => '', 3 => null, 4 => 'qux', 5 => 0, null => 'value', '' => 'string']);

        $result = $collection->except();

        assert_true($result instanceof Collection);
        assert_true([2 => '', 3 => null, 5 => 0] === $result->items());
    }
);
