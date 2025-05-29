<?php

use PhpRepos\Datatype\Str;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should assert two string are equal',
    case: function () {
        assert_true(Str\assert_equal('hello', 'hello'));
        $actual = new class implements Stringable {
            public function __toString(): string
            {
                return 'hello';
            }
        };
        assert_true(Str\assert_equal($actual, 'hello'));
        $expected = new class implements Stringable {
            public function __toString(): string
            {
                return 'hello';
            }
        };
        assert_true(Str\assert_equal($actual, $expected));

        try {
            Str\assert_equal('hello', 'world');
            assert_false(true, 'It should throw exception');
        } catch (AssertionError $exception) {
            assert_true($exception->getMessage() === 'Strings are not equal. Expected `world` but the actual string is `hello`.');
        }
    }
);

test(
    title: 'it should assert two string are the same',
    case: function () {
        assert_true(Str\assert_same('hello', 'hello'));

        $string = new class implements Stringable {
            public function __toString(): string
            {
                return 'hello';
            }
        };
        assert_true(Str\assert_same($string, $string));

        try {
            assert_true(Str\assert_same($string, 'hello'));
            assert_false(true, 'It should throw exception');
        } catch (AssertionError $exception) {
            Str\assert_equal($exception->getMessage(), 'Strings are not the same. Expected `'. print_r('hello', true) . '` but the actual string is `' . print_r($string, true) . '`.');
        }

        try {
            Str\assert_same('hello', 'world');
            assert_false(true, 'It should throw exception');
        } catch (AssertionError $exception) {
            Str\assert_equal($exception->getMessage(), 'Strings are not the same. Expected `world` but the actual string is `hello`.');
        }
    }
);
