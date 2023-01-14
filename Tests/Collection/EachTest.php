<?php

namespace Tests\Collection\EachTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should run the given closure against each item',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        $result = [];
        $actual = $collection->each(function ($value, $key) use (&$result) {
            $result[] = $key . $value;
        });

        assert_true($actual instanceof Collection);
        assert_true([1 => 'foo', 2 => 'bar'] === $actual->items());
        assert_true(['1foo', '2bar'] === $result);
    }
);
