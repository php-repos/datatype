<?php

namespace Tests\Arr\MapTest;

use function PhpRepos\Datatype\Arr\map;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should map the given array to given callback',
    case: function () {
        $array = [1, 2, 3, 4];

        assert_true([0, 2, 6, 12] === map($array, fn ($item, $key) => $key * $item));
    }
);
