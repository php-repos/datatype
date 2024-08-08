<?php

namespace Tests\Str\FirstCharacterTest;

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return first character',
    case: function () {
        assert_true('H' === Str\first_character('Hello World'), 'First character is not what we want');
        assert_true(' ' === Str\first_character(' Hello World!'), 'First character is not what we want');
        assert_true('' === Str\first_character(''), 'First character is not what we want');
    }
);
