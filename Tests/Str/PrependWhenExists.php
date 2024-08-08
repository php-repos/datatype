<?php

namespace Tests\Str\PrependWhenExistsTest;

use function PhpRepos\Datatype\Str\prepend_when_exists;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should prepend the prefix to the subject when it exists',
    case: function () {
        $subject = "world";
        $prefix = "Hello, ";
        assert_true("Hello, world" === prepend_when_exists($subject, $prefix));
    }
);

test(
    title: 'it should return an empty string when the subject is null',
    case: function () {
        $subject = null;
        $prefix = "Hello, ";
        assert_true("" === prepend_when_exists($subject, $prefix));
    }
);

test(
    title: 'it should return an empty string when the subject is an empty string',
    case: function () {
        $subject = "";
        $prefix = "Hello, ";
        assert_true("" === prepend_when_exists($subject, $prefix));
    }
);

test(
    title: 'it should handle a non-empty subject with an empty prefix',
    case: function () {
        $subject = "world";
        $prefix = "";
        assert_true("world" === prepend_when_exists($subject, $prefix));
    }
);

test(
    title: 'it should handle a null subject with an empty prefix',
    case: function () {
        $subject = null;
        $prefix = "";
        assert_true("" === prepend_when_exists($subject, $prefix));
    }
);

test(
    title: 'it should handle a subject with whitespace and prepend the prefix',
    case: function () {
        $subject = "  there";
        $prefix = "Hello, ";
        assert_true("Hello,   there" === prepend_when_exists($subject, $prefix));
    }
);
