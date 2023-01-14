<?php

namespace Tests\Str\BeforeFirstOccurrenceTest;

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return subject string when needle is empty',
    case: function () {
        $subject = 'hello world';
        assert_true('hello world' === Str\before_first_occurrence($subject, ''));
    }
);

test(
    title: 'it should return the substring before the first occurrence',
    case: function () {
        $subject = 'My\Class\Name';
        assert_true('My' === Str\before_first_occurrence($subject, '\\'));

        $subject = 'This is another sentence contains i to test';
        assert_true('This is another senten' === Str\before_first_occurrence($subject, 'c'));
    }
);

test(
    title: 'it should return subject string when needle is not in the subject',
    case: function () {
        $subject = 'hello world';
        assert_true('hello world' === Str\before_first_occurrence($subject, 'my'));
    }
);
