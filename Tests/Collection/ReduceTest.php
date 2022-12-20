<?php

namespace Tests\Collection\ReduceTest;

use Saeghe\Datatype\Collection;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should reduce collection',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        $actual = $collection->reduce(function ($carry, $value) {
            return $value === 'bar' || $carry;
        }, false);

        assert_true($actual);
    }
);

test(
    title: 'it should reduce collection using key',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        $actual = $collection->reduce(function ($carry, $value, $key) {
            return $key === 2 || $carry;
        }, false);

        assert_true($actual);
    }
);

test(
    title: 'it should set carry as null when not passed',
    case: function () {
        $collection = new Collection([1 => 'foo', 2 => 'bar']);

        $actual = $collection->reduce(function ($carry) {
            return $carry;
        });

        assert_true(is_null($actual));
    }
);
