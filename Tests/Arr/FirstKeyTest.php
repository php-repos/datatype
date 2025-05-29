<?php

use function PhpRepos\Datatype\Arr\first_key;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should first key item of the array',
    case: function () {
        $arr = ['foo', 'baz'];
        assert_true(0 === first_key($arr), 'list key is not working');
    }
);

test(
    title: 'it should return any type as the first key item',
    case: function () {
        $arr = [null => 'foo', 'foo' => 'bar'];
        assert_true('' === first_key($arr), 'null key is not working');

        $arr = [1 => 'bar', 'foo' => 'baz'];
        assert_true(1 === first_key($arr), 'number key is not working');

        $arr = ['foo' => ['bar'], 'bar' => 'baz'];
        assert_true('foo' === first_key($arr), 'string key is not working');
    }
);

test(
    title: 'it should return null when the given array is empty',
    case: function () {
        $arr = [];
        assert_true(null === first_key($arr), 'key for empty array is not working');
    }
);

test(
    title: 'it should return the first key one that meets the condition',
    case: function () {
        $arr = ['foo' => 1, 'bar' => 2, 'baz' => 2];
        assert_true('bar' === first_key($arr, fn ($item) => $item === 2), 'key with closure is not working');
    }
);
