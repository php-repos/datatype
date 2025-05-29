<?php

namespace Tests;

use ArrayIterator;
use AssertionError;
use InvalidArgumentException;
use PhpRepos\Datatype\Collection;
use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\to_array;
use function PhpRepos\Datatype\Arr\assert_same;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should assert two given array are the same',
    case: function () {
        $array1 = ['a', 'b', 'c'];
        $array2 = ['a', 'b', 'c', 'd'];

        assert_same($array1, $array1);

        try {
            assert_same($array1, $array2);
            assert_false(true, 'Array\assert_same is not working as expected!');
        } catch (AssertionError $exception) {
            $actual = print_r($array1, true);
            $expected = print_r($array2, true);
            assert_true($exception->getMessage() === "Arrays are not the same. Expected $expected but the actual array is $actual", $exception->getMessage());
        }
    }
);

test(
    title: 'it should convert the given iterable to an array',
    case: function () {
        $array = ['a', 'b'];
        assert_same(to_array($array), ['a', 'b']);

        $array_iterator = new ArrayIterator(['c', 'd']);
        assert_same(to_array($array_iterator), ['c', 'd']);

        $generator = function () {
            yield 'e';
            yield 'f';
        };
        assert_same(iterator_to_array($generator()), ['e', 'f']);

        $class = new class extends ArrayIterator {
            public function to_array(): array
            {
                return ['g', 'h'];
            }
        };
        assert_same(to_array($class), ['g', 'h']);

        try {
            to_array('not valid type');
            assert_false(true, 'it should not work with invalid types!');
        } catch (InvalidArgumentException $exception) {
            assert_true($exception->getMessage() === 'Input must be an array, an iterable, or has a `to_array` method.', 'Exception: ' . $exception->getMessage());
        }

        assert_equal(new Collection([1, 2, 3]), [1, 2, 3]);
    }
);

test(
    title: 'it should assert equality by checking the values and not considering the type',
    case: function () {
        $array = ['a', 'b'];
        $array_iterator = new ArrayIterator(['a', 'b']);
        $generator = function () {
            yield 'a';
            yield 'b';
        };
        $class = new class extends ArrayIterator {
            public function __invoke(){}
            public function to_array(): array
            {
                return ['a', 'b'];
            }
        };
        assert_equal($array, ['a', 'b']);
        assert_equal($array_iterator, $array);
        assert_equal(iterator_to_array($generator()), $array_iterator);
        assert_equal($class, iterator_to_array($generator()));
    }
);
