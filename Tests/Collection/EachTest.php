<?php

namespace Tests\Collection\EachTest;

use Saeghe\Datatype\Collection;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should run the given closure against each item',
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

        $result = [];
        $actual = $collection->each(function ($value, $key) use (&$result) {
            $result[] = $key . $value;
        });

        assert_true($actual instanceof Collection);
        assert_true([1 => 'foo', 2 => 'bar'] === $actual->items());
        assert_true(['1foo', '2bar'] === $result);
    }
);