<?php

use function PhpRepos\Datatype\Arr\insert_after;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should put given value after given key in array',
    case: function () {
        $arr = ['foo', 'baz'];
        $result = insert_after($arr, 0, ['bar']);
        assert_true(['foo', 'bar', 'baz'] === $result);
    }
);

test(
    title: 'it should put given value after given key in array in associative array',
    case: function () {
        $arr = ['a' => 'foo', 'b' => 'baz'];
        $result = insert_after($arr, 'a', ['c' => 'bar']);
        assert_true(['a' => 'foo', 'c' => 'bar', 'b' => 'baz'] === $result);
    }
);

test(
    title: 'it should put given value at the end of the array when given key not exists',
    case: function () {
        $arr = ['a' => 'foo', 'b' => 'baz'];
        $result = insert_after($arr, 'd', ['c' => 'bar']);
        assert_true(['a' => 'foo', 'b' => 'baz', 'c' => 'bar'] === $result);
    }
);
