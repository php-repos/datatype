<?php

use function PhpRepos\Datatype\Arr\take_first;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return first value where condition passes and unset item from the main items',
    case: function () {
        $arr = ['foo', 'bar', 'baz'];
        $result = take_first($arr, fn ($item, $key) => $item === 'bar');

        assert_true('bar' === $result);
        assert_true([0 => 'foo', 2 => 'baz'] === $arr);
    }
);

test(
    title: 'it should return null and keep array intact when condition does not meet for items',
    case: function () {
        $arr = ['foo', 'bar', 'baz'];
        $result = take_first($arr, fn ($item, $key) => $item === 'qux');

        assert_true(null === $result);
        assert_true([0 => 'foo', 1 => 'bar', 2 => 'baz'] === $arr);
    }
);
