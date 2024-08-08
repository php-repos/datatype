<?php

namespace Tests\Arr\ReduceTest;

use function PhpRepos\Datatype\Arr\reduce;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return the carry when given array is empty',
    case: function () {
        assert_true('foo' === reduce([], fn ($carry, $value, $key) => $value, 'foo'));
    }
);

test(
    title: 'it should reduce given array by the given closure',
    case: function () {
        assert_true('bar' === reduce(['foo', 'bar', 'baz'], fn ($carry, $value, $key) => $key === 1 ? $value : $carry));
    }
);
