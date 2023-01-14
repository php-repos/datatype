<?php

namespace Tests\Text\TextTest;

use PhpRepos\Datatype\Text;
use Stringable;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it can construct a text without initial data',
    case: function () {
        $text = new Text();

        assert_true('' === $text->string());
    }
);

test(
    title: 'it can construct a text with empty string',
    case: function () {
        $text = new Text('');

        assert_true('' === $text->string());
    }
);


test(
    title: 'it can construct a text with stringable object',
    case: function () {
        $stringable = new class(['a' => 'b']) implements Stringable {
            public function __construct(private array $arr) {}

            public function __toString(): string
            {
                return json_encode($this->arr);
            }
        };
        $text = new Text($stringable);

        assert_true((string) $stringable === $text->string());
    }
);

test(
    title: 'it should implement stringable',
    case: function () {
        $text = new Text('hello world');
        assert_true('hello world' === (string) $text);
    }
);
