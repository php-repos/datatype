<?php

use PhpRepos\Datatype\Text;
use function PhpRepos\Datatype\Str\assert_equal;
use function PhpRepos\Datatype\Str\before_first_occurrence;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should create a text',
    case: function () {
        assert_equal((new Text())->string(), '');
        assert_equal((new Text('hello world'))->string(), 'hello world');
        assert_equal((string) new Text('hello world'),  'hello world');
        assert_equal(Text::from('hello world')->string(),  'hello world');
    }
);

test(
    title: 'it should set the text',
    case: function () {
        $text = new Text('hello world');
        $text->set('bye bye');
        assert_equal($text, 'bye bye');
    }
);

test(
    title: 'it should append the given subjects',
    case: function () {
        $text = new Text('Hello');
        $text->append(' ');
        assert_equal($text, 'Hello ');
        $text->append('World', '!');
        assert_equal($text, 'Hello World!');
    }
);

test(
    title: 'it should concat to the text',
    case: function () {
        $text = new Text('Hello');
        $text->concat(', ', 'beautiful', 'world');

        assert_equal($text, 'Hello, beautiful, world');
    }
);

test(
    title: 'it should convert to cases',
    case: function () {
        $text = Text::from('hello world');
        assert_equal($text->camel_case(), 'helloWorld');
        assert_equal($text->kebab_case(), 'hello-world');
        assert_equal($text->pascal_case(), 'HelloWorld');
        assert_equal($text->snake_case(), 'hello_world');
    }
);

test(
    title: 'it should remove the first character',
    case: function () {
        $text = Text::from('!Hello World!');
        assert_equal($text->remove_first_character(), 'Hello World!');
    }
);

test(
    title: 'it should remove the last character',
    case: function () {
        $text = Text::from('Hello World!');
        assert_equal($text->remove_last_character(), 'Hello World');
    }
);

test(
    title: 'it should map text',
    case: function () {
        $text = Text::from('hello world');
        assert_equal($text->map('strtoupper'), 'HELLO WORLD');
        assert_equal($text->map(fn ($string) => before_first_occurrence($string, 'W')), 'HELLO ');
    }
);
