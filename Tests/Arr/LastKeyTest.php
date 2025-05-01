<?php

use function PhpRepos\Datatype\Arr\last_key;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should last key item of the array',
    case: function () {
        $arr = ['foo', 'baz'];
        assert_true(1 === last_key($arr), 'list key is not working');
    }
);

test(
    title: 'it should return any type as the last key item',
    case: function () {
        $arr = ['foo' => 'bar', null => 'foo'];
        assert_true('' === last_key($arr), 'null key is not working');

        $arr = ['foo' => 'baz', 1 => 'bar'];
        assert_true(1 === last_key($arr), 'number key is not working');

        $arr = ['bar' => 'baz', 'foo' => ['bar']];
        assert_true('foo' === last_key($arr), 'string key is not working');
    }
);

test(
    title: 'it should return null when the given array is empty',
    case: function () {
        $arr = [];
        assert_true(null === last_key($arr), 'key for empty array is not working');
    }
);

test(
    title: 'it should return the last key one that meets the condition',
    case: function () {
        $arr = ['foo' => 1, 'bar' => 2, 'baz' => 2];
        assert_true('baz' === last_key($arr, fn ($item) => $item === 2), 'key with closure is not working');
    }
);
