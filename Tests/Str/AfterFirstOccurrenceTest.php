<?php

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return subject string when needle is empty',
    case: function () {
        $subject = 'hello world';
        assert_true($subject === Str\after_first_occurrence($subject, ''));
        assert_true(' hello world' === Str\after_first_occurrence('This is hello world', 'This is'));
    }
);

test(
    title: 'it should return the substring after the first occurrence',
    case: function () {
        $subject = 'My\Class\Name';
        assert_true('Class\Name' === Str\after_first_occurrence($subject, '\\'));

        $subject = 'This is another sentence contains i to test';
        assert_true('e contains i to test' === Str\after_first_occurrence($subject, 'c'));
    }
);

test(
    title: 'it should return the substring after the first occurrence for multibyte string',
    case: function () {
        $subject = 'Привет мир!';
        assert_true('мир!' === Str\after_first_occurrence($subject, 'Привет '));
    }
);

test(
    title: 'it should return subject string when needle is not in the subject',
    case: function () {
        $subject = 'hello world';
        assert_true($subject === Str\after_first_occurrence($subject, 'my'));
    }
);
