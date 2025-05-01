<?php

use PhpRepos\Datatype\Set;
use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\assert_same;
use function PhpRepos\Datatype\Arr\reduce;
use function PhpRepos\TestRunner\Runner\test;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;

test(
    title: 'it should create a set',
    case: function () {
        assert_equal(new Set(), []);
        assert_equal(new Set([]), []);
        assert_equal(new Set([1, 2, 3]), [1, 2, 3]);
        assert_same(new Set([1, 2, 3])->to_array(), [1, 2, 3]);

        $set = Set::from(['foo', 'bar', 'baz']);
        assert_equal($set, ['foo', 'bar', 'baz']);

        $set = Set::range(1, 5);
        assert_equal($set, [1, 2, 3,4, 5]);

        $set = Set::alphabet();
        assert_equal($set, ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z']);
    }
);

test(
    title: 'it should map items of the set',
    case: function () {
        $set = Set::alphabet();
        assert_equal($set->map('strtoupper'), ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']);

        $set = Set::range(1, 5);
        assert_equal($set->map(fn ($item) => $item * 2), [2, 4, 6, 8, 10]);
    }
);

test(
    title: 'it should add to the set',
    case: function () {
        $set = new Set([1, 2]);
        $set->add(3);
        assert_equal($set, [1, 2, 3]);

        $set->add(4, 5);
        assert_equal($set, [1, 2, 3, 4, 5]);

        $set->add(4, 5);
        assert_equal($set, [1, 2, 3, 4, 5]);
    }
);

test(
    title: 'it should allow array access to a set',
    case: function () {
        $set = new Set([1, 2]);

        assert_true(reduce($set, fn ($carry, $item) => $carry + $item, 0) === 3);

        $set[2] = 2;
        assert_equal($set, [1, 2]);

        $set[2] = 3;
        assert_equal($set, [1, 2, 3]);
    }
);

test(
    title: 'it should remove given values from the set',
    case: function () {
        $set = new Set([1, 2, 3, 4, 5]);
        assert_equal($set->remove(3), [1, 2, 4, 5]);

        assert_equal($set->remove(2, 4), [1, 5]);

        $set->remove(6);
        assert_equal($set, [1, 5]);
    }
);

test(
    title: 'it should forget items by the given condition',
    case: function () {
        $set = new Set(['foo', 'bar', 'baz', 'qux']);

        assert_equal($set->forget(fn (string $item) => str_starts_with($item, 'b')), ['foo', 'qux']);
    }
);

test(
    title: 'it should clear the set',
    case: function () {
        $set = Set::range(1, 10);
        assert_equal($set->clear(), []);
    }
);
