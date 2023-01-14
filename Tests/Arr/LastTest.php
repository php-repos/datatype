<?php

namespace Tests\Arr\LastTest;

use function PhpRepos\Datatype\Arr\last;
use function PhpRepos\Datatype\Str\first_character;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should last item of the array',
    case: function () {
        $arr = ['foo', 'baz'];
        assert_true('baz' === last($arr));
    }
);

test(
    title: 'it should return any type as the last item',
    case: function () {
        $arr = ['foo', null];
        assert_true(null === last($arr));

        $arr = ['foo', 1];
        assert_true(1 === last($arr));

        $arr = ['foo', ['bar']];
        assert_true(['bar'] === last($arr));
    }
);

test(
    title: 'it should return null when the given array is empty',
    case: function () {
        $arr = [];
        assert_true(null === last($arr));
    }
);

test(
    title: 'it should return the last one that meets the condition',
    case: function () {
        $arr = ['foo', 'bar', 'baz'];
        assert_true('baz' === last($arr, fn ($item) => first_character($item) === 'b'));
    }
);
