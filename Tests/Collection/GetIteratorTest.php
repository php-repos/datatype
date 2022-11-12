<?php

namespace Tests\Collection\GetIteratorTest;

use Saeghe\Datatype\Collection;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should implement getIterator',
    case: function () {
        $collection = new class(['foo' => 'bar', 'baz' => 'qux']) extends Collection {
            public function key_is_valid(mixed $key): bool
            {
                return true;
            }

            public function value_is_valid(mixed $value): bool
            {
                return true;
            }
        };

        $actual = [];
        foreach ($collection as $key => $value) {
            $actual[$key] = $value;
        }

        assert_true($actual === ['foo' => 'bar', 'baz' => 'qux']);
    }
);