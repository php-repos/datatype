<?php

use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\filter;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return empty array when the given array is empty',
    case: function () {
        assert_equal(filter([]), []);
        assert_equal(filter([], fn ($item) => (bool) $item), []);
    }
);

test(
    title: 'it should filter array by the given condition',
    case: function () {
        $arr = ['foo', 'bar' => 'baz'];
        assert_equal(filter($arr, fn ($item, $key) => (bool) $item), $arr);
        assert_equal(filter($arr, fn ($item, $key) => str_starts_with($item, 'f')), ['foo']);
        assert_equal(filter($arr, fn ($item, $key) => $key === 'bar'), ['bar' => 'baz']);
    }
);

