<?php

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return the substring after the given position',
    case: function () {
        $subject = 'hello world';
        Str\assert_equal(Str\after($subject, 0), 'hello world');
        Str\assert_equal(Str\after('This is hello world', 7), ' hello world');
    }
);
