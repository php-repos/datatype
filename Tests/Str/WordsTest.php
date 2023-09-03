<?php

namespace Tests\Str\WordsTest;

use function PhpRepos\Datatype\Str\words;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should split a string into words separated by spaces',
    case: function () {
        $subject = "Hello World";
        $expected = ["Hello", "World"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle a string with multiple spaces between words',
    case: function () {
        $subject = "This   is   a   test";
        $expected = ["This", "is", "a", "test"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle leading and trailing spaces',
    case: function () {
        $subject = "  Trim   ";
        $expected = ["Trim"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle a string with only spaces',
    case: function () {
        $subject = "    ";
        $expected = [];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle an empty string',
    case: function () {
        $subject = "";
        $expected = [];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should split a string using custom separators',
    case: function () {
        $subject = "apple,banana|cherry";
        $expected = ["apple", "banana", "cherry"];
        assert_true($expected === words($subject, ",|"));
    }
);

test(
    title: 'it should handle non-breaking spaces (UTF-8)',
    case: function () {
        $subject = "Hello, World!";
        $expected = ["Hello, World!"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle a string with newline characters',
    case: function () {
        $subject = "Hello\nWorld!";
        $expected = ["Hello", "World!"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle a string with special characters',
    case: function () {
        $subject = "this-is_a.test!";
        $expected = ["this-is_a.test!"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle a string with numbers',
    case: function () {
        $subject = "hello123world";
        $expected = ["hello123world"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should handle a string with mixed characters',
    case: function () {
        $subject = "Hello, World!123";
        $expected = ["Hello,", "World!123"];
        assert_true($expected === words($subject));
    }
);

test(
    title: 'it should split a string into words using custom separators (comma and pipe)',
    case: function () {
        $subject = "apple,banana|cherry";
        $expected = ["apple", "banana", "cherry"];
        assert_true($expected === words($subject, ",|"));
    }
);

test(
    title: 'it should split a string into words using custom separators (semicolon and colon)',
    case: function () {
        $subject = "one;two:three";
        $expected = ["one", "two", "three"];
        assert_true($expected === words($subject, ";:"));
    }
);

test(
    title: 'it should split a string into words using custom separators (hyphen and underscore)',
    case: function () {
        $subject = "first-second_third";
        $expected = ["first", "second", "third"];
        assert_true($expected === words($subject, "-_"));
    }
);

