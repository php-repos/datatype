<?php

namespace Tests\Arr\EveryTest;

use Saeghe\Datatype\Collection;
use function Saeghe\TestRunner\Assertions\Boolean\assert_false;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it return true when every item has value',
    case: function () {
        $collection = new Collection([1, 2, 3]);
        assert_true($collection->every());
        $collection = new Collection(['foo', 'bar', 'baz']);
        assert_true($collection->every());
    }
);

test(
    title: 'it return false when items are empty',
    case: function () {
        $collection = new Collection([null, 0, '', []]);
        assert_false($collection->every());
    }
);

test(
    title: 'it should return true when every item passes the check',
    case: function () {
        $collection = new Collection(['foo', 'bar', 'baz']);
        assert_true($collection->every(fn ($item) => is_string($item)));

        $collection = new Collection(['foo', 'bar', 'baz']);
        assert_true($collection->every(fn ($item, $key) => is_numeric($key)));

        $collection = new Collection(['foo', 'bar', 'baz']);
        assert_false($collection->every(fn ($item, $key) => strlen($item) > 3));
    }
);
