<?php

namespace Tests\Pair\PairTest;

use PhpRepos\Datatype\Pair;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should make a pair',
    case: function () {
        $pair = new Pair(1, 'foo');
        assert_true(['key' => 1, 'value' => 'foo'] === $pair->get());
    }
);
