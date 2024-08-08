<?php

namespace Tests\Str\CamelCaseTest;

use function PhpRepos\Datatype\Str\camel_case;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    'it should return camel case for a sentence',
    function () {
        $subject = "This is a regular sentence.";
        assert_true('thisIsARegularSentence.' === camel_case($subject));
    }
);

test(
    'it should return an empty string for an empty input',
    function () {
        $subject = "";
        assert_true('' === camel_case($subject));
    }
);

test(
    'it should handle UTF-8 characters',
    function () {
        $subject = "Café au lait";
        assert_true('caféAuLait' === camel_case($subject));
    }
);

test(
    'it should handle numbers in the input',
    function () {
        $subject = "hello123 world456";
        assert_true('hello123World456' === camel_case($subject));
    }
);

test(
    'it should handle special characters and punctuation',
    function () {
        $subject = "snake_case-function: Test!";
        assert_true('snakeCaseFunction:Test!' === camel_case($subject));
    }
);
