<?php

namespace Tests\Collection\GetIteratorTest;

use PhpRepos\Datatype\Collection;
use function PhpRepos\TestRunner\Assertions\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should implement getIterator',
    case: function () {
        $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);

        $actual = [];
        foreach ($collection as $key => $value) {
            $actual[$key] = $value;
        }

        assert_true($actual === ['foo' => 'bar', 'baz' => 'qux']);
    }
);
