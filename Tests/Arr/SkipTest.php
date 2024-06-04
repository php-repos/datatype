<?php

namespace Tests\Arr\SkipTest;

use function PhpRepos\Datatype\Arr\skip;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should skip up to given offset',
    case: function () {
        $arr = ['foo', 'bar', 'baz'];

        assert_true(['foo', 'bar', 'baz'] === skip($arr, 0));
        assert_true(['bar', 'baz'] === skip($arr, 1));
        assert_true(['baz'] === skip($arr, 2));
        assert_true([] === skip($arr, 3));
    }
);
