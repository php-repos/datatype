<?php

namespace Tests\Arr\ForgetTest;

use function Saeghe\Datatype\Arr\forget;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should forget items that passes the given condition',
    case: function () {
        $array = ['foo', 'bar', 'baz'];

        assert_true([2 => 'baz'] === forget($array, fn ($value, $key) => $value === 'foo' || $key === 1));
    }
);
