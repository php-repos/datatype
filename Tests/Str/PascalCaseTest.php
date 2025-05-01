<?php

use function PhpRepos\Datatype\Str\pascal_case;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should convert a string to standard PascalCase (basic)',
    case: function () {
        $subject = "this is a sample string";
        $expected = "ThisIsASampleString";
        assert_true($expected === pascal_case($subject));
    }
);

test(
    title: 'it should handle non-alphanumeric characters (basic)',
    case: function () {
        $subject = 'this! is 123 a &sample $tring';
        $expected = 'This!Is123A&sample$tring';
        assert_true($expected === pascal_case($subject));
    }
);

test(
    title: 'it should handle UTF-8 characters (multibyte)',
    case: function () {
        $subject = "Café Lögo!";
        $expected = "CaféLögo!";
        assert_true($expected === pascal_case($subject));
    }
);

test(
    title: 'it should return the subject when starts with number',
    case: function () {
        $subject = "123abc";
        $expected = "123abc";
        assert_true($expected === pascal_case($subject));
    }
);

test(
    title: 'it should handle a string with leading non-alphanumeric characters',
    case: function () {
        $subject = "!@#abc";
        $expected = "!@#abc";
        assert_true($expected === pascal_case($subject));
    }
);

test(
    title: 'it should handle an empty string',
    case: function () {
        $subject = "";
        $expected = "";
        assert_true($expected === pascal_case($subject));
    }
);

