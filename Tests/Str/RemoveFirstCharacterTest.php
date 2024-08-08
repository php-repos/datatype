<?php

namespace Tests\Str\RemoveFirstCharacterTest;

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should remove first character',
    case: function () {
        $subject = 'hello world';
        assert_true('ello world' === Str\remove_first_character($subject));
    }
);

test(
    title: 'it should remove first character for multibyte string',
    case: function () {
        $subject = 'привет мир';
        assert_true('ривет мир' === Str\remove_first_character($subject));
    }
);

test(
    title: 'it should return empty string when subject is empty',
    case: function () {
        $subject = '';
        assert_true('' === Str\remove_first_character($subject));
    }
);
