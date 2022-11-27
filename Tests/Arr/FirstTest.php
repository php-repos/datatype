<?php

namespace Tests\Arr\FirstTest;

use function Saeghe\Datatype\Arr\first;
use function Saeghe\Datatype\Str\first_character;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should first item of the array',
    case: function () {
        $arr = ['foo', 'baz'];
        assert_true('foo' === first($arr));
    }
);

test(
    title: 'it should return any type as the first item',
    case: function () {
        $arr = [null, 'foo'];
        assert_true(null === first($arr));

        $arr = [1, 'foo'];
        assert_true(1 === first($arr));

        $arr = [['bar'], 'foo'];
        assert_true(['bar'] === first($arr));
    }
);

test(
    title: 'it should return null when the given array is empty',
    case: function () {
        $arr = [];
        assert_true(null === first($arr));
    }
);

test(
    title: 'it should return the first one that meets the condition',
    case: function () {
        $arr = ['foo', 'bar', 'baz'];
        assert_true('bar' === first($arr, fn ($item) => first_character($item) === 'b'));
    }
);
