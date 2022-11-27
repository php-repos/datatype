<?php

namespace Tests\Arr\HasTest;

use function Saeghe\Datatype\Arr\has;
use function Saeghe\TestRunner\Assertions\Boolean\assert_false;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should return true if array has item with the given condition',
    case: function () {
        $arr = ['foo' => 'bar', 'baz' => 'qux'];
        assert_true(has($arr, fn ($item, $key) => $item === 'qux'));
        assert_true(has($arr, fn ($item, $key) => $key === 'baz'));
        assert_false(has($arr, fn ($item, $key) => $key === 0));
        assert_false(has($arr, fn ($item, $key) => $item === null));
    }
);

