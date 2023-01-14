<?php

namespace Tests\Collection\LastTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\Datatype\Str\first_character;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should last item of the collection',
    case: function () {
        $collection = new Collection(['foo', 'baz']);
        assert_true('baz' === $collection->last());
    }
);

test(
    title: 'it should return any type as the last item',
    case: function () {
        $collection = new Collection(['foo', null]);
        assert_true(null === $collection->last());

        $collection = new Collection(['foo', 1]);
        assert_true(1 === $collection->last());

        $collection = new Collection(['foo', ['bar']]);
        assert_true(['bar'] === $collection->last());
    }
);

test(
    title: 'it should return null when the given collection is empty',
    case: function () {
        $collection = new Collection([]);
        assert_true(null === $collection->last());
    }
);

test(
    title: 'it should return the last one that meets the condition',
    case: function () {
        $collection = new Collection(['foo', 'bar', 'baz']);
        assert_true('baz' === $collection->last(fn ($item) => first_character($item) === 'b'));
    }
);
