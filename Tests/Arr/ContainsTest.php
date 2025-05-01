<?php

use function PhpRepos\Datatype\Arr\contains;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return true if array contains the given value',
    case: function () {
        $arr = ['foo' => 'bar', 'baz' => 'qux'];
        assert_true(contains($arr, 'bar'));
        assert_true(contains($arr, 'qux'));
        assert_false(contains($arr, 'foo'));
        assert_false(contains($arr, null));
    }
);

