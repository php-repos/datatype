<?php

namespace Tests\Str\RemoveLastCharacterTest;

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should remove last character',
    case: function () {
        $subject = 'hello world';
        assert_true('hello worl' === Str\remove_last_character($subject));
    }
);

test(
    title: 'it should return empty string when subject is empty',
    case: function () {
        $subject = '';
        assert_true('' === Str\remove_last_character($subject));
    }
);
