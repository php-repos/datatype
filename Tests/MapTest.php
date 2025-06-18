<?php

use PhpRepos\Datatype\Map;
use function PhpRepos\Datatype\Arr\assert_equal;
use function PhpRepos\Datatype\Arr\assert_same;
use function PhpRepos\Datatype\Arr\reduce;
use function PhpRepos\TestRunner\Runner\test;
use function PhpRepos\TestRunner\Assertions\assert_false;
use function PhpRepos\TestRunner\Assertions\assert_true;

test(
    title: 'it should create a map',
    case: function () {
        assert_same(new Map()->to_array(), []);
        assert_equal(new Map(), []);
        assert_equal(new Map([]), []);
        assert_equal(new Map([[1, 'foo'], ['bar', 2]]), [['key' => 1, 'value' => 'foo'], ['key' => 'bar', 'value' => 2]]);
        assert_equal(new Map([['value' => 1, 'key' => 'foo'], ['key' => 'bar', 'value' => 2]]), [['key' => 'foo', 'value' => 1], ['key' => 'bar', 'value' => 2]]);
        assert_equal(Map::from([['key' => 'name', 'value' => 'john'], ['key' => 'family', 'value' => 'doe']]), new Map([['name', 'john'], ['family', 'doe']]));
    }
);

test(
    title: 'it should construct a map using associative array',
    case: function () {
        assert_equal(Map::from_associative(['foo', 'bar']), [['key' => 0, 'value' => 'foo'], ['key' => 1, 'value' => 'bar']]);
        assert_equal(Map::from_associative([1 => 'foo', 2 => 'bar']), [['key' => 1, 'value' => 'foo'], ['key' => 2, 'value' => 'bar']]);
        assert_equal(Map::from_associative(['foo' => 1, 'bar' => 2]), [['key' => 'foo', 'value' => 1], ['key' => 'bar', 'value' => 2]]);
    }
);

test(
    title: 'it should return an associative array of the map, if possible',
    case: function () {
        assert_equal(Map::from([['key' => 'name', 'value' => 'john'], ['key' => 'family', 'value' => 'doe']])->to_associative_array(), ['name' => 'john', 'family' => 'doe']);
        assert_equal(Map::from_associative(['foo', 'bar'])->to_associative_array(), ['foo', 'bar']);
    }
);

test(
    title: 'it should put new items in map',
    case: function () {
        $map = new Map();
        $map->put(1, 'foo');
        assert_equal($map, [['key' => 1, 'value' => 'foo']]);
        $map->put(2, 'foo');
        assert_equal($map, [['key' => 1, 'value' => 'foo'], ['key' => 2, 'value' => 'foo']]);

        $map->put(2, 'bar');
        assert_equal($map, [['key' => 1, 'value' => 'foo'], ['key' => 2, 'value' => 'foo']]);
    }
);

test(
    title: 'it should forget using the given condition',
    case: function () {
        $map = new Map([[1, 2], ['foo', 'bar'], [3, 4], ['baz', 'quo'], [5, 'hello world']]);

        $map->forget(fn (array $pair) => is_string($pair['value']));

        assert_equal($map, [['key' => 1, 'value' => 2], ['key' => 3, 'value' => 4]]);
    }
);

test(
    title: 'it should swap items',
    case: function () {
        $map = new Map([[1, 2], [3, 4]]);
        assert_equal($map, [['key' => 1, 'value' => 2], ['key' => 3, 'value' => 4]]);
        $map->swap(1, 'hello');
        assert_equal($map, [['key' => 1, 'value' => 'hello'], ['key' => 3, 'value' => 4]]);
        $map->swap(3, 5);
        assert_equal($map, [['key' => 1, 'value' => 'hello'], ['key' => 3, 'value' => 5]]);

        $map->swap(6, 'not exists');
        assert_equal($map, [['key' => 1, 'value' => 'hello'], ['key' => 3, 'value' => 5]]);
    }
);

test(
    title: 'it should set the given item to the map',
    case: function () {
        $map = new Map([[1, 2], [3, 4]]);
        $map->set(5, 6);
        assert_equal($map, [['key' => 1, 'value' => 2], ['key' => 3, 'value' => 4], ['key' => 5, 'value' => 6]]);
        $map->set(3, 7);
        assert_equal($map, [['key' => 1, 'value' => 2], ['key' => 3, 'value' => 7], ['key' => 5, 'value' => 6]]);
    }
);

test(
    title: 'it should work as array',
    case: function () {
        $map = new Map([[1, 'foo'], [2, 'bar']]);
        $map[3] = 'baz';
        assert_equal($map, [['key' => 1, 'value' => 'foo'], ['key' => 2, 'value' => 'bar'], ['key' => 3, 'value' => 'baz']]);

        assert_true(reduce($map, fn (int $carry, array $pair) => $carry + $pair['key'], 0) === 6, 'Can not access map as array');

        unset($map[2]);
        assert_equal($map, [['key' => 1, 'value' => 'foo'], ['key' => 3, 'value' => 'baz']]);

        assert_true($map[3] === 'baz');
        try {
            assert_true($map[4] === null);
        } catch (OutOfBoundsException $exception) {
            assert_true($exception->getMessage() === 'Key `4` not found in map.', $exception->getMessage());
        }

    }
);

test(
    title: 'it should map the map`s items',
    case: function () {
        $map = Map::from([['key' => 'name', 'value' => 'john'], ['key' => 'family', 'value' => 'doe']]);
        assert_equal($map->map(fn ($value) => strtoupper($value)), [['key' => 'name', 'value' => 'JOHN'], ['key' => 'family', 'value' => 'DOE']]);

        $map = Map::from([['key' => 1, 'value' => 2], ['key' => 3, 'value' => 4], ['key' => 5, 'value' => 6]]);
        assert_equal($map->map(fn ($value, $key) => $value * 2), [['key' => 1, 'value' => 4], ['key' => 3, 'value' => 8], ['key' => 5, 'value' => 12]]);
    }
);
