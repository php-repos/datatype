<?php

use function PhpRepos\Datatype\Arr\any;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it return false when no item has value',
    case: function () {
        assert_true(any([null, 0, '', []]));
    }
);

test(
    title: 'it return true when an item has a value',
    case: function () {
        assert_true(any([null, 0, '', [], true]));
    }
);

test(
    title: 'it should return true when any item passes the check',
    case: function () {
        assert_true(any(['foo', 'bar', 'baz'], fn ($item) => str_starts_with($item, 'b')));
        assert_false(any(['foo', 'bar', 'baz'], fn ($item, $key) => is_numeric($item)));
        assert_false(any(['foo', 'bar', 'baz'], fn ($item, $key) => $key > 3));
    }
);

test(
    title: 'it should return true if there is any item with the given condition',
    case: function () {
        $arr = ['foo' => 'bar', 'baz' => 'qux'];
        assert_true(any($arr, fn ($item, $key) => $item === 'qux'));
        assert_true(any($arr, fn ($item, $key) => $key === 'baz'));
        assert_false(any($arr, fn ($item, $key) => $key === 0));
        assert_false(any($arr, fn ($item, $key) => $item === null));
    }
);
