<?php

namespace Tests\Arr\EveryTest;

use function Saeghe\Datatype\Arr\every;
use function Saeghe\TestRunner\Assertions\Boolean\assert_false;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it return true when every item has value',
    case: function () {
        assert_true(every([1, 2, 3]));
        assert_true(every(['foo', 'bar', 'baz']));
    }
);

test(
    title: 'it return false when items are empty',
    case: function () {
        assert_false(every([null, 0, '', []]));
    }
);

test(
    title: 'it should return true when every item passes the check',
    case: function () {
        assert_true(every(['foo', 'bar', 'baz'], fn ($item) => is_string($item)));
        assert_true(every(['foo', 'bar', 'baz'], fn ($item, $key) => is_numeric($key)));
        assert_false(every(['foo', 'bar', 'baz'], fn ($item, $key) => strlen($item) > 3));
    }
);
