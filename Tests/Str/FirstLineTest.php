<?php

use function PhpRepos\Datatype\Str\first_line;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return first line when newline is present',
    case: function () {
        $subject = "This is the first line.\nThis is the second line.";
        assert_true("This is the first line." === first_line($subject));
    }
);

test(
    title: 'it should return first line when newline is not present',
    case: function () {
        $subject = "This is the only line.";
        assert_true("This is the only line." === first_line($subject));
    }
);

test(
    title: 'it should trim leading and trailing whitespace',
    case: function () {
        $subject = "   This is the first line.   \n   ";
        assert_true("This is the first line." === first_line($subject));
    }
);

test(
    title: 'it should handle leading newline characters',
    case: function () {
        $subject = "\nThis is the first line.\nThis is the second line.";
        assert_true("This is the first line." === first_line($subject));
    }
);

test(
    title: 'it should handle trailing newline characters',
    case: function () {
        $subject = "This is the first line.\nThis is the second line.\n";
        assert_true("This is the first line." === first_line($subject));
    }
);

test(
    title: 'it should return an empty string for an empty input',
    case: function () {
        $subject = "";
        assert_true("" === first_line($subject));
    }
);

test(
    title: 'it should return an empty string for a string with only whitespace',
    case: function () {
        $subject = "   \n   \n   ";
        assert_true("" === first_line($subject));
    }
);
