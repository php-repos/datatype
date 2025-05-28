<?php

namespace PhpRepos\Datatype\Arr;

use AssertionError;
use InvalidArgumentException;

/**
 * Converts a mixed input to an array.
 *
 * @param mixed $input The input to convert. Can be an array, an iterable, or an object with a to_array method.
 * @return array The converted array.
 * @throws InvalidArgumentException If the input is not an array, iterable, or does not have a to_array method.
 * @example
 * ```php
 * $array = to_array([1, 2, 3]); // Returns [1, 2, 3]
 * $array = to_array(new ArrayIterator([1, 2, 3])); // Returns [1, 2, 3]
 * $object = new class { public function to_array() { return ['a' => 1]; } };
 * $array = to_array($object); // Returns ['a' => 1]
 * $array = to_array(123); // Throws InvalidArgumentException
 * ```
 */
function to_array(mixed $input): array
{
    if (is_array($input)) {
        return $input;
    }
    if (method_exists($input, 'to_array')) {
        return $input->to_array();
    }
    if (is_iterable($input)) {
        return iterator_to_array($input);
    }

    throw new InvalidArgumentException('Input must be an array, an iterable, or has a `to_array` method.');
}

/**
 * Asserts that two iterables are equal (same values in the same order).
 *
 * @param iterable $actual The actual iterable to compare.
 * @param iterable $expected The expected iterable to compare against.
 * @param string|null $message Optional custom error message for the assertion failure.
 * @return true Returns true if the iterables are equal.
 * @throws AssertionError If the iterables are not equal.
 * @example
 * ```php
 * assert_equal([1, 2, 3], [1, 2, 3]); // Returns true
 * assert_equal([1, 2], [1, 2, 3], "Arrays must match"); // Throws AssertionError
 * ```
 */
function assert_equal(iterable $actual, iterable $expected, ?string $message = null): true
{
    $actual = to_array($actual);
    $expected = to_array($expected);

    if ($actual === $expected) {
        return true;
    }

    if ($message) {
        throw new AssertionError($message);
    }

    $actual = print_r($actual, true);
    $expected = print_r($expected, true);

    throw new AssertionError("Arrays are not equal. Expected $expected but the actual array is $actual");
}

/**
 * Asserts that two iterables are identical (same values and same references).
 *
 * @param iterable $actual The actual iterable to compare.
 * @param iterable $expected The expected iterable to compare against.
 * @param string|null $message Optional custom error message for the assertion failure.
 * @return true Returns true if the iterables are identical.
 * @throws AssertionError If the iterables are not identical.
 * @example
 * ```php
 * $arr = [1, 2, 3];
 * assert_same($arr, $arr); // Returns true
 * assert_same([1, 2], [1, 2], "Must be same"); // Throws AssertionError
 * ```
 */
function assert_same(iterable $actual, iterable $expected, ?string $message = null): true
{
    if ($actual === $expected) {
        return true;
    }

    if ($message) {
        throw new AssertionError($message);
    }

    $actual = print_r($actual, true);
    $expected = print_r($expected, true);

    throw new AssertionError("Arrays are not the same. Expected $expected but the actual array is $actual");
}

/**
 * Checks if all elements in an iterable satisfy a condition or are truthy.
 *
 * @param iterable $array The iterable to check.
 * @param callable|null $condition Optional callback to test each element. Receives value and key as parameters.
 * @return bool True if all elements satisfy the condition or are truthy, false otherwise.
 * @example
 * ```php
 * $result = all([1, 2, 3], fn($value) => $value > 0); // Returns true
 * $result = all([1, 0, 3]); // Returns false
 * ```
 */
function all(iterable $array, ?callable $condition = null): bool
{
    $array = to_array($array);

    if (is_callable($condition)) {
        if (function_exists('array_all')) {
            return array_all($array, $condition);
        }

        foreach ($array as $key => $value) {
            if (!$condition($value, $key)) {
                return false;
            }
        }

        return true;
    }

    return count(array_filter($array)) === count($array);
}

/**
 * Checks if any element in an iterable satisfies a condition or if the iterable is non-empty.
 *
 * @param iterable $array The iterable to check.
 * @param callable|null $condition Optional callback to test each element. Receives value and key as parameters.
 * @return bool True if any element satisfies the condition or if the iterable is non-empty, false otherwise.
 * @example
 * ```php
 * $result = any([1, 2, 3], fn($value) => $value > 2); // Returns true
 * $result = any([]); // Returns false
 * ```
 */
function any(iterable $array, ?callable $condition = null): bool
{
    $array = to_array($array);

    if (is_callable($condition)) {
        if (function_exists('array_any')) {
            return array_any($array, $condition);
        }

        foreach ($array as $key => $value) {
            if ($condition($value, $key)) {
                return true;
            }
        }

        return false;
    }

    return ! empty($array);
}

/**
 * Computes the Cartesian product of an iterable of arrays.
 *
 * @param iterable $array The input iterable containing arrays to compute the Cartesian product.
 * @return array An array of arrays representing all possible combinations.
 * @example
 * ```php
 * $result = cartesian_product([[1, 2], ['a', 'b']]); // Returns [[1, 'a'], [1, 'b'], [2, 'a'], [2, 'b']]
 * $result = cartesian_product([]); // Returns [[]]
 * ```
 */
function cartesian_product(iterable $array): array
{
    $array = to_array($array);

    if (empty($array)) {
        return [[]];
    }

    $first = array_shift($array);
    $sub_product = cartesian_product($array);

    $result = [];
    foreach ($first as $item) {
        foreach ($sub_product as $product) {
            $result[] = array_merge([$item], $product);
        }
    }

    return $result;
}

/**
 * Checks if an iterable contains a specific value.
 *
 * @param iterable $array The iterable to check.
 * @param mixed $value The value to search for.
 * @return bool True if the value exists in the iterable, false otherwise.
 * @example
 * ```php
 * $result = contains([1, 2, 3], 2); // Returns true
 * $result = contains(['a' => 1, 'b' => 2], 3); // Returns false
 * ```
 */
function contains(iterable $array, mixed $value): bool
{
    return in_array($value, to_array($array));
}

/**
 * Retrieves the first key in an iterable that satisfies a condition or the first key overall.
 *
 * @param iterable $array The iterable to search.
 * @param callable|null $condition Optional callback to test each element. Receives value and key as parameters.
 * @return string|int|null The first key that matches the condition, the first key of the array, or null if empty.
 * @example
 * ```php
 * $key = first_key(['a' => 1, 'b' => 2], fn($value) => $value > 1); // Returns 'b'
 * $key = first_key(['x' => 10, 'y' => 20]); // Returns 'x'
 * ```
 */
function first_key(iterable $array, ?callable $condition = null): string|int|null
{
    if (is_callable($condition)) {
        foreach ($array as $key => $value) {
            if ($condition($value, $key)) {
                return $key;
            }
        }

        return null;
    }

    return array_key_first(to_array($array)) ?? null;
}

/**
 * Retrieves the first value in an iterable that satisfies a condition or the first value overall.
 *
 * @param iterable $array The iterable to search.
 * @param callable|null $condition Optional callback to test each element. Receives value and key as parameters.
 * @return mixed The first value that matches the condition, the first value of the array, or null if empty.
 * @example
 * ```php
 * $value = first(['a' => 1, 'b' => 2], fn($value) => $value > 1); // Returns 2
 * $value = first(['x' => 10, 'y' => 20]); // Returns 10
 * ```
 */
function first(iterable $array, ?callable $condition = null): mixed
{
    if (is_callable($condition)) {
        foreach ($array as $key => $value) {
            if ($condition($value, $key)) {
                return $value;
            }
        }

        return null;
    }

    $array = to_array($array);

    return $array[array_key_first($array)] ?? null;
}

/**
 * Removes elements from an iterable that satisfy a condition.
 *
 * @param iterable $array The iterable to process.
 * @param callable $condition Callback to test each element. Receives value and key as parameters.
 * @return array The filtered array with elements that do not satisfy the condition.
 * @example
 * ```php
 * $result = forget(['a' => 1, 'b' => 2, 'c' => 3], fn($value) => $value > 1); // Returns ['a' => 1]
 * ```
 */
function forget(iterable $array, callable $condition): array
{
    foreach ($array as $key => $value) {
        if ($condition($value, $key)) {
            unset($array[$key]);
        }
    }

    return to_array($array);
}

/**
 * Checks if an iterable contains an element that satisfies a condition.
 *
 * @param iterable $array The iterable to check.
 * @param callable $callable Callback to test each element. Receives value and key as parameters.
 * @return bool True if any element satisfies the condition, false otherwise.
 * @example
 * ```php
 * $result = has([1, 2, 3], fn($value) => $value > 2); // Returns true
 * $result = has([1, 2], fn($value) => $value > 3); // Returns false
 * ```
 */
function has(iterable $array, callable $callable): bool
{
    return any($array, fn($value, $key) => $callable($value, $key));
}

/**
 * Filters an iterable based on a callback or truthy values.
 *
 * @param iterable $array The iterable to filter.
 * @param callable|null $callback Optional callback to test each element. Receives value and key as parameters.
 * @return array The filtered array containing elements that satisfy the callback or are truthy.
 * @example
 * ```php
 * $result = filter([1, 0, 3], fn($value) => $value > 0); // Returns [0 => 1, 2 => 3]
 * $result = filter([1, false, 3]); // Returns [0 => 1, 2 => 3]
 * ```
 */
function filter(iterable $array, ?callable $callback = null): array
{
    $array = to_array($array);

    return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
}

/**
 * Inserts additional elements into an array after a specified key.
 *
 * @param iterable $array The input iterable.
 * @param mixed $key The key after which to insert the additional elements.
 * @param iterable $additional The elements to insert.
 * @return array The resulting array with the additional elements inserted.
 * @example
 * ```php
 * $result = insert_after(['a' => 1, 'b' => 2], 'a', ['x' => 10]); // Returns ['a' => 1, 'x' => 10, 'b' => 2]
 * ```
 */
function insert_after(iterable $array, mixed $key, iterable $additional): array
{
    $array = to_array($array);
    $additional = to_array($additional);
    $keys = array_keys($array);
    $index = array_search($key, $keys);
    $pos = false === $index ? count($array) : $index + 1;

    return array_merge(array_slice($array, 0, $pos), $additional, array_slice($array, $pos));
}

/**
 * Retrieves the last key in an iterable that satisfies a condition or the last key overall.
 *
 * @param iterable $array The iterable to search.
 * @param callable|null $condition Optional callback to test each element. Receives value and key as parameters.
 * @return string|int|null The last key that matches the condition, the last key of the array, or null if empty.
 * @example
 * ```php
 * $key = last_key(['a' => 1, 'b' => 2], fn($value) => $value > 1); // Returns 'b'
 * $key = last_key(['x' => 10, 'y' => 20]); // Returns 'y'
 * ```
 */
function last_key(iterable $array, ?callable $condition = null): null|int|string
{
    if (is_callable($condition)) {
        $last = null;
        foreach ($array as $key => $value) {
            $last = $condition($value, $key) ? $key : $last;
        }

        return $last;
    }

    $array = to_array($array);

    return array_key_last($array) ?? null;
}

/**
 * Retrieves the last value in an iterable that satisfies a condition or the last value overall.
 *
 * @param iterable $array The iterable to search.
 * @param callable|null $condition Optional callback to test each element. Receives value and key as parameters.
 * @return mixed The last value that matches the condition, the last value of the array, or null if empty.
 * @example
 * ```php
 * $value = last(['a' => 1, 'b' => 2], fn($value) => $value > 1); // Returns 2
 * $value = last(['x' => 10, 'y' => 20]); // Returns 20
 * ```
 */
function last(iterable $array, ?callable $condition = null): mixed
{
    if (is_callable($condition)) {
        $last = null;
        foreach ($array as $key => $value) {
            $last = $condition($value, $key) ? $value : $last;
        }

        return $last;
    }

    $array = to_array($array);

    return $array[array_key_last($array)] ?? null;
}

/**
 * Maps an iterable using a callback function, passing both value and key.
 *
 * @param iterable $array The iterable to map.
 * @param callable $callback Callback to apply to each element. Receives value and key as parameters.
 * @return array The resulting array after applying the callback.
 * @example
 * ```php
 * $result = map([1, 2, 3], fn($value, $key) => $value * 2); // Returns [2, 4, 6]
 * ```
 */
function map(iterable $array, callable $callback): array
{
    $array = to_array($array);
    return array_map($callback, array_values($array), array_keys($array));
}

/**
 * Calculates the maximum length of keys in an iterable.
 *
 * @param iterable $array The iterable to process.
 * @return int The maximum length of keys, or 0 if the iterable is empty.
 * @example
 * ```php
 * $length = max_key_length(['abc' => 1, 'de' => 2]); // Returns 3
 * $length = max_key_length([]); // Returns 0
 * ```
 */
function max_key_length(iterable $array): int
{
    return empty($array) ? 0 : max(array_map('mb_strlen', array_keys(to_array($array))));
}

/**
 * Merges multiple iterables into a single array.
 *
 * Combines the elements of the provided iterables, preserving keys for associative arrays and reindexing numeric keys.
 * Each iterable is converted to an array using to_array before merging.
 *
 * @param iterable ...$arrays The iterables to merge (arrays, ArrayAccess, or objects with to_array method).
 * @return array The merged array.
 * @example
 * ```php
 * $result = merge([1, 2], ['a' => 3, 4], new ArrayIterator([5]));
 * // Returns [1, 2, 'a' => 3, 4, 5]
 * ```
 */
function merge(iterable ...$arrays): array
{
    $result = [];
    foreach ($arrays as $array) {
        $result = array_merge($result, to_array($array));
    }

    return $result;
}

/**
 * Reduces an iterable to a single value using a callback.
 *
 * @param iterable $array The iterable to reduce.
 * @param callable $callback Callback to apply to each element. Receives carry, value, and key as parameters.
 * @param mixed $carry Initial value for the reduction.
 * @return mixed The final reduced value.
 * @example
 * ```php
 * $sum = reduce([1, 2, 3], fn($carry, $value) => $carry + $value, 0); // Returns 6
 * ```
 */
function reduce(iterable $array, callable $callback, mixed $carry = null): mixed
{
    $array = to_array($array);
    return array_reduce(
        array_keys($array),
        fn ($carry, $key) => $callback($carry, $array[$key], $key),
        $carry
    );
}

/**
 * Removes and returns the first element in an array that satisfies a condition.
 *
 * @param array $array The array to process (passed by reference).
 * @param callable $condition Callback to test each element. Receives value and key as parameters.
 * @return mixed The first value that matches the condition
 * ```php
 * $array = ['a' => 1, 'b' => 2, 'c' => 3];
 * $value = take_first($array, fn($value) => $value > 1); // Returns 2, $array becomes ['a' => 1, 'c' => 3]
 * ```
 */
function take_first(array &$array, callable $condition): mixed
{
    if (is_null($key = first_key($array, $condition))) {
        return null;
    }

    $result = $array[$key];

    unset($array[$key]);

    return $result;
}
