<?php

namespace Tests\Str\ConcatTest;

use function PhpRepos\Datatype\Str\concat;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should concatenate two non-empty strings with a suffix',
    case: function () {
        $suffix = ", ";
        $subject1 = "Hello";
        $subject2 = "world";
        assert_true("Hello, world" === concat($suffix, $subject1, $subject2));
    }
);

test(
    title: 'it should concatenate multiple non-empty strings with a suffix',
    case: function () {
        $suffix = ", ";
        $subject1 = "Hello";
        $subject2 = "beautiful";
        $subject3 = "world";
        assert_true("Hello, beautiful, world" === concat($suffix, $subject1, $subject2, $subject3));
    }
);

test(
    title: 'it should concatenate two non-empty strings with an empty suffix',
    case: function () {
        $suffix = "";
        $subject1 = "Hello";
        $subject2 = "world";
        assert_true("Helloworld" === concat($suffix, $subject1, $subject2));
    }
);

test(
    title: 'it should concatenate a non-empty string and a null subject with a suffix',
    case: function () {
        $suffix = ", ";
        $subject1 = "Hello";
        $subject2 = null;
        assert_true("Hello" === concat($suffix, $subject1, $subject2));
    }
);

test(
    title: 'it should return an empty string for two null subjects',
    case: function () {
        $suffix = ", ";
        $subject1 = null;
        $subject2 = null;
        assert_true("" === concat($suffix, $subject1, $subject2));
    }
);

test(
    title: 'it should concatenate multiple strings with null subjects and a suffix',
    case: function () {
        $suffix = ", ";
        $subject1 = "Hello";
        $subject2 = null;
        $subject3 = "world";
        $subject4 = null;
        assert_true("Hello, world" === concat($suffix, $subject1, $subject2, $subject3, $subject4));
    }
);

test(
    title: 'it should concatenate multiple strings with empty subjects and a suffix',
    case: function () {
        $suffix = ", ";
        $subject1 = "Hello";
        $subject2 = "";
        $subject3 = "world";
        $subject4 = "";
        assert_true("Hello, world" === concat($suffix, $subject1, $subject2, $subject3, $subject4));
    }
);

