<?php

namespace Tests\Str\LastCharacterTest;

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return last character',
    case: function () {
        assert_true('d' === Str\last_character('Hello World'), 'Last character is not what we want');
        assert_true('!' === Str\last_character('Hello World!'), 'Last character is not what we want');
        assert_true('' === Str\last_character(''), 'Last character is not what we want');
    }
);
