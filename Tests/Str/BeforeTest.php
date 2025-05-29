<?php

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return substring before the given position',
    case: function () {
        $subject = 'hello world';
        Str\assert_equal(Str\before($subject, 11), 'hello world');
        Str\assert_equal(Str\before($subject, 5), 'hello');
    }
);
