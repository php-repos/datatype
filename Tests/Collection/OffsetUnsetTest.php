<?php

namespace Tests\Collection\OffsetUnsetTest;

use Saeghe\Datatype\Collection;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should check should implement offsetUnset',
    case: function () {
        $collection = new class([1 => 'foo', 2 => 'bar']) extends Collection {
            public function key_is_valid(mixed $key): bool
            {
                return true;
            }

            public function value_is_valid(mixed $value): bool
            {
                return true;
            }
        };

        $collection->offsetUnset(2);

        assert_true([1 => 'foo'] === $collection->items());
    }
);