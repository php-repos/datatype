<?php

namespace Tests\Arr\ForgetTest;

use function PhpRepos\Datatype\Arr\forget;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should forget items that passes the given condition',
    case: function () {
        $array = ['foo', 'bar', 'baz'];

        assert_true([2 => 'baz'] === forget($array, fn ($value, $key) => $value === 'foo' || $key === 1));
    }
);
