<?php

use function PhpRepos\Datatype\Str\snake_case;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    'it should convert a regular sentence to snake_case',
    function () {
        $subject = "This is a regular sentence.";
        assert_true('this_is_a_regular_sentence.' === snake_case($subject));
    }
);

test(
    'it should convert a camelCase sentence to kebab_case',
    function () {
        $subject = "thisIsCamelCase";
        assert_true('this_is_camel_case' === snake_case($subject));
    }
);

test(
    'it should handle an empty input string',
    function () {
        $subject = "";
        assert_true('' === snake_case($subject));
    }
);

test(
    'it should handle special characters and punctuation',
    function () {
        $subject = "camel_case-function: Test!";
        assert_true('camel_case_function:_test!' === snake_case($subject));
    }
);

test(
    'it should handle numbers in the input',
    function () {
        $subject = "hello123 world456";
        assert_true('hello123_world456' === snake_case($subject));
    }
);

test(
    'it should handle spaces and underscores',
    function () {
        $subject = "a b-c_d--e";
        assert_true('a_b_c_d_e' === snake_case($subject));
    }
);

test(
    'it should handle UTF-8 characters in the input',
    function () {
        $subject = "Café au lait";
        assert_true('café_au_lait' === snake_case($subject));
    }
);
