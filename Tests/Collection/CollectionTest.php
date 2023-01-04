<?php

namespace Tests\Collection\CollectionTest;

use ArrayAccess;
use Countable;
use Saeghe\Datatype\Collection;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it can construct a collection without initial data',
    case: function () {
        $collection = new Collection();

        assert_true($collection instanceof \ArrayAccess);
        assert_true([] === $collection->items());
    }
);

test(
    title: 'it can construct a collection with empty collection',
    case: function () {
        $collection = new Collection([]);

        assert_true([] === $collection->items());
    }
);

test(
    title: 'it should return count of the items',
    case: function () {
        $collection = new Collection(['foo', 'bar', 'baz', 'qux']);

        assert_true($collection instanceof \Countable);
        assert_true(4 === count($collection));
    }
);
