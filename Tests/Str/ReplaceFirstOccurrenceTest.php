<?php

namespace Tests\Str\ReplaceFirstOccurrenceTest;

use Saeghe\Datatype\Str;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should replace first occurrence of sub string',
    case: function () {
        assert_true('hello universe' === Str\replace_first_occurrence('hello world', 'world', 'universe'));
        assert_true('hello universe world' === Str\replace_first_occurrence('hello world world', 'world', 'universe'));
        assert_true('hi world hello' === Str\replace_first_occurrence('hello world hello', 'hello', 'hi'));
        assert_true('' === Str\replace_first_occurrence('', 'hello', 'hi'));
        assert_true('hello world' === Str\replace_first_occurrence('hello world', 'universe', 'hi'));
    }
);

test(
    title: 'it should replace first occurrence of sub string for multibyte string',
    case: function () {
        assert_true('привет вселенная' === Str\replace_first_occurrence('привет мир', 'мир', 'вселенная'));
    }
);
