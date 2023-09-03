<?php

namespace Tests\Str\KebabCaseTest;

use function PhpRepos\Datatype\Str\kebab_case;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    'it should convert a regular sentence to kebab_case',
    function () {
        $subject = "This is a regular sentence.";
        assert_true('this-is-a-regular-sentence.' === kebab_case($subject));
    }
);

test(
    'it should convert a camelCase sentence to kebab_case',
    function () {
        $subject = "thisIsCamelCase";
        assert_true('this-is-camel-case' === kebab_case($subject));
    }
);

test(
    'it should handle an empty input string',
    function () {
        $subject = "";
        assert_true('' === kebab_case($subject));
    }
);

test(
    'it should handle special characters and punctuation',
    function () {
        $subject = "camel_case-function: Test!";
        assert_true('camel-case-function:-test!' === kebab_case($subject));
    }
);

test(
    'it should handle numbers in the input',
    function () {
        $subject = "hello123 world456";
        assert_true('hello123-world456' === kebab_case($subject));
    }
);

test(
    'it should handle spaces and underscores',
    function () {
        $subject = "a b_c-d__e";
        assert_true('a-b-c-d-e' === kebab_case($subject));
    }
);

test(
    'it should handle UTF-8 characters in the input',
    function () {
        $subject = "Café au lait";
        assert_true('café-au-lait' === kebab_case($subject));
    }
);
