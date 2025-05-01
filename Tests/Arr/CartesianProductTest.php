<?php

use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\cartesian_product;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should compute cartesian product of two arrays',
    case: function () {
        $input = [
            ['A', 'B'],
            [1, 2]
        ];
        $expected = [
            ['A', 1], ['A', 2],
            ['B', 1], ['B', 2],
        ];
        assert_equal(cartesian_product($input), $expected);
    }
);

test(
    title: 'it should compute cartesian product of a single array',
    case: function () {
        $input = [['x', 'y']];
        $expected = [['x'], ['y']];
        assert_equal(cartesian_product($input), $expected);
    }
);

test(
    title: 'it should compute cartesian product of three arrays',
    case: function () {
        $input = [
            ['a', 'b'],
            ['1'],
            ['x', 'y']
        ];
        $expected = [
            ['a', '1', 'x'],
            ['a', '1', 'y'],
            ['b', '1', 'x'],
            ['b', '1', 'y'],
        ];
        assert_equal(cartesian_product($input), $expected);
    }
);

test(
    title: 'it should return an empty set if any array is empty',
    case: function () {
        $input = [
            ['a', 'b'],
            [],
            ['x', 'y']
        ];
        $expected = [];
        assert_equal(cartesian_product($input), $expected);
    }
);

test(
    title: 'it should return one empty array when input is empty',
    case: function () {
        $input = [];
        $expected = [[]];
        assert_equal(cartesian_product($input), $expected);
    }
);
