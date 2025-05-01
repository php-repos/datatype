<?php

use PhpRepos\Datatype\Collection;
use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\assert_same;
use function PhpRepos\TestRunner\Runner\test;
use function PhpRepos\TestRunner\Assertions\assert_true;

test(
    title: 'it should create a collection',
    case: function () {
        assert_same(new Collection()->to_array(), []);
        assert_equal(new Collection(), []);
        assert_equal(new Collection([]), []);
        assert_equal(new Collection([1 => 'foo', 'bar' => 2]), [1 => 'foo', 'bar' => 2]);
    }
);

test(
    title: 'it should make a collection',
    case: function () {
        assert_equal(Collection::make([1, 'a', null, true]), [1, 'a', null, true]);
        assert_same(Collection::make([1, 'a', null, true])->to_array(), [1, 'a', null, true]);
    }
);

test(
    title: 'it should forget items that match given condition',
    case: function () {
        $collection = Collection::make([1 => 'foo', 'bar' => 'baz', 3 => 'hello world']);

        assert_equal($collection->forget(fn ($item, $key) => $key === 1 || $item === 'baz'), [3 => 'hello world']);
    }
);

test(
    title: 'it should map collection items',
    case: function () {
        $collection = Collection::make([1, 2, 3, 4]);

        assert_equal($collection->map(fn ($item) => $item * 2), [2, 4, 6, 8]);
    }
);

test(
    title: 'it should put the given value in the given offset',
    case: function () {
        $collection = new Collection();
        $collection->put('foo');
        $collection->put('bar', 2);
        assert_equal($collection, ['foo', 2 => 'bar']);

        $collection->put('baz', 2);
        assert_equal($collection, ['foo', 2 => 'baz']);
    }
);

test(
    title: 'it should push the given values to the end of collection',
    case: function () {
        $collection = new Collection();
        $collection->put('foo');
        $collection->push('bar');
        assert_equal($collection, ['foo', 'bar']);
        $collection->put('baz', 3);
        assert_equal($collection, ['foo', 'bar', 3 => 'baz']);
        $collection->push('qux');
        assert_equal($collection, ['foo', 'bar', 3 => 'baz', 4 => 'qux']);
        $collection->push('hello', 'world');
        assert_equal($collection, ['foo', 'bar', 3 => 'baz', 4 => 'qux', 5 => 'hello', 6 => 'world']);
    }
);

test(
    title: 'it should set the given value in the given offset',
    case: function () {
        $collection = new Collection();
        $collection->set(1, 'foo');
        assert_equal($collection, [1 => 'foo']);

        $collection->set(1, 'bar');
        assert_equal($collection, [1 => 'bar']);

        $collection->set(null, 'bar');
        assert_equal($collection, [1 => 'bar', null => 'bar']);
    }
);

test(
    title: 'it should take the first value meeting the given condition',
    case: function () {
        $collection = Collection::make(['foo', 'bar', 'baz', 'qux']);
        $result = $collection->take_first(fn ($item) => str_starts_with($item, 'b'));
        assert_equal($collection, [0 => 'foo', 2 => 'baz', 3 => 'qux']);
        assert_true($result === 'bar');
    }
);
