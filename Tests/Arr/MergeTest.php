<?php

use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\merge;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should merge given iterables',
    case: function () {
        assert_equal(merge([]), []);
        assert_equal(merge([], []), []);
        $array1 = [1, 2];
        $array2 = [2, 3];
        $array3 = [4, 5, 6];
        assert_equal(merge($array1, $array2), [1, 2, 2, 3]);
        assert_equal(merge($array1, $array2, $array3), [1, 2, 2, 3, 4, 5, 6]);
    }
);
