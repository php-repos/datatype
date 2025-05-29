<?php

use function PhpRepos\Datatype\Arr\all;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it return true when all item has value',
    case: function () {
        assert_true(all([1, 2, 3]));
        assert_true(all(['foo', 'bar', 'baz']));
    }
);

test(
    title: 'it return false when items are empty',
    case: function () {
        assert_false(all([null, 0, '', []]));
    }
);

test(
    title: 'it should return true when all item passes the check',
    case: function () {
        assert_true(all(['foo', 'bar', 'baz'], fn ($item) => is_string($item)));
        assert_true(all(['foo', 'bar', 'baz'], fn ($item, $key) => is_numeric($key)));
        assert_false(all(['foo', 'bar', 'baz'], fn ($item, $key) => strlen($item) > 3));
    }
);
