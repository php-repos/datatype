<?php

namespace PhpRepos\Datatype\Arr;

use Closure;
use PhpRepos\Datatype\Collection;
use PhpRepos\Datatype\Map;

function every(array $array, ?Closure $check = null): bool
{
    if (is_callable($check)) {
        foreach ($array as $key => $value) {
            if (! $check($value, $key)) {
                return false;
            }
        }

        return true;
    }

    return ! empty(array_filter($array));
}

function first_key(array $array, ?Closure $condition = null): string|int|null
{
    if (is_callable($condition)) {
        foreach ($array as $key => $value) {
            if ($condition($value, $key)) {
                return $key;
            }
        }

        return null;
    }

    return array_key_first($array) ?? null;
}

function first(array $array, ?Closure $condition = null): mixed
{
    if (is_callable($condition)) {
        foreach ($array as $key => $value) {
            if ($condition($value, $key)) {
                return $value;
            }
        }

        return null;
    }

    return $array[array_key_first($array)] ?? null;
}

function forget(array $array, Closure $condition): array
{
    foreach ($array as $key => $value) {
        if ($condition($value, $key)) {
            unset($array[$key]);
        }
    }

    return $array;
}

function has(array $array, Closure $closure): bool
{
    foreach ($array as $key => $value) {
        if ($closure($value, $key)) {
            return true;
        }
    }

    return false;
}

function insert_after(array $array, mixed $key, array $additional): array
{
    $keys = array_keys($array);
    $index = array_search($key, $keys);
    $pos = false === $index ? count($array) : $index + 1;

    return array_merge(array_slice($array, 0, $pos), $additional, array_slice($array, $pos));
}

function last_key(array $array, ?Closure $condition = null): null|int|string
{
    if (is_callable($condition)) {
        $last = null;
        foreach ($array as $key => $value) {
            $last = $condition($value, $key) ? $key : $last;
        }

        return $last;
    }

    return array_key_last($array) ?? null;
}

function last(array $array, ?Closure $condition = null): mixed
{
    if (is_callable($condition)) {
        $last = null;
        foreach ($array as $key => $value) {
            $last = $condition($value, $key) ? $value : $last;
        }

        return $last;
    }

    return $array[array_key_last($array)] ?? null;
}

function map(array $array, Closure $callback): array
{
    return array_map($callback, array_values($array), array_keys($array));
}

function max_key_length(array|Collection|Map $array): int
{
    $keys = is_array($array) ? array_keys($array) : $array->keys();
    return empty($array) ? 0 : max(array_map('mb_strlen', $keys));
}

function reduce(array $array, Closure $callback, mixed $carry = null): mixed
{
    return array_reduce(
        array_keys($array),
        fn ($carry, $key) => $callback($carry, $array[$key], $key),
        $carry
    );
}

function skip(array $array, int $offset): array
{
    return array_slice($array, $offset);
}

function take(array &$array, Closure $condition): mixed
{
    if (is_null($key = first_key($array, $condition))) {
        return null;
    }

    $result = $array[$key];

    unset($array[$key]);

    return $result;
}
