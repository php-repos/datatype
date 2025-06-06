<?php

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return the subject when needle is empty',
    case: function () {
        $subject = 'hello world';
        assert_true($subject === Str\before_last_occurrence($subject, ''));
    }
);

test(
    title: 'it should return the substring before the last occurrence',
    case: function () {
        $subject = 'My\Class\Name';
        assert_true('My\Class' === Str\before_last_occurrence($subject, '\\'));

        $subject = 'This is another sentence contains i to test';
        assert_true('This is another sentence contains ' === Str\before_last_occurrence($subject, 'i'));
    }
);

test(
    title: 'it should return subject string when needle is not in the subject',
    case: function () {
        $subject = 'hello world';
        assert_true('hello world' === Str\before_last_occurrence($subject, 'my'));
    }
);
