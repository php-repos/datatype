<?php

namespace Tests\Text\SetTest;

use PhpRepos\Datatype\Text;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should set given text',
    case: function () {
        $text = new Text('original');

        $text->set('modify');

        assert_true('modify' === $text->string());
    }
);
