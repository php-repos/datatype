<?php

namespace Tests\Arr\MaxKeyLengthTest;

use PhpRepos\Datatype\Collection;
use PhpRepos\Datatype\Map;
use PhpRepos\Datatype\Pair;
use function PhpRepos\Datatype\Arr\max_key_length;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should return max key length for the given array',
    case: function () {
        $array = ['apple' => 5, 'banana' => 6, 'cherry' => 6];
        assert_true(6 === max_key_length($array));
    }
);

test(
    title: 'it should return 0 for an empty array',
    case: function () {
        $array = [];
        assert_true(0 === max_key_length($array));
    }
);

test(
    title: 'it should handle numeric keys',
    case: function () {
        $array = [1 => 'one', 22 => 'twenty-two', 333 => 'three hundred thirty-three'];
        assert_true(3 === max_key_length($array));
    }
);

test(
    title: 'it should handle special characters in keys',
    case: function () {
        $array = ['@key' => 'value', '$special_key' => 'another value'];
        assert_true(12 === max_key_length($array));
    }
);

test(
    title: 'it should check the first dimension of nested array',
    case: function () {
        $array = ['name' => ['apple' => 'red', 'banana' => 'yellow'], 'color' => ['red' => 'apple', 'yellow' => 'banana']];
        assert_true(5 === max_key_length($array));
    }
);

test(
    title: 'it should handle a collection as input',
    case: function () {
        $array = new Collection(['name' => 'John', 'family' => 'Doe']);
        assert_true(6 === max_key_length($array));
    }
);

test(
    title: 'it should handle a map as input',
    case: function () {
        $map = new Map();
        $map->put(new Pair(1, 'foo'));
        $map->put(new Pair(10, 'bar'));

        assert_true(2 === max_key_length($map));
    }
);

test(
    title: 'it should handle multibyte characters in keys',
    case: function () {
        $array = ['café' => 'coffee', 'über' => 'over'];
        assert_true(4 === max_key_length($array));
    }
);

test(
    title: 'it should handle keys with leading and trailing whitespace',
    case: function () {
        $array = [' key1 ' => 'value1', ' key2  ' => 'value2  '];
        assert_true(7 === max_key_length($array));
    }
);

test(
    title: 'it should handle keys with line breaks and tabs',
    case: function () {
        $array = ["key\n1" => 'value1', "key\t2" => 'value2'];
        assert_true(5 === max_key_length($array));
    }
);
