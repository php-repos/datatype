<?php

namespace Tests\Collection\FirstTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\Datatype\Str\first_character;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should first item of the collection',
    case: function () {
        $collection = new Collection(['foo', 'baz']);
        assert_true('foo' === $collection->first());
    }
);

test(
    title: 'it should return any type as the first item',
    case: function () {
        $collection = new Collection([null, 'foo']);
        assert_true(null === $collection->first());

        $collection = new Collection([1, 'foo']);
        assert_true(1 === $collection->first());

        $collection = new Collection([['bar'], 'foo']);
        assert_true(['bar'] === $collection->first());
    }
);

test(
    title: 'it should return null when the given collection is empty',
    case: function () {
        $collection = new Collection([]);
        assert_true(null === $collection->first());
    }
);

test(
    title: 'it should return the first one that meets the condition',
    case: function () {
        $collection = new Collection(['foo', 'bar', 'baz']);
        assert_true('bar' === $collection->first(fn ($item) => first_character($item) === 'b'));
    }
);
