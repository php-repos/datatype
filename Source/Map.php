<?php

namespace PhpRepos\Datatype;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use OutOfBoundsException;
use Traversable;
use function PhpRepos\Datatype\Arr\first;
use function PhpRepos\Datatype\Arr\first_key;
use function PhpRepos\Datatype\Arr\forget;
use function PhpRepos\Datatype\Arr\has;
use function PhpRepos\Datatype\Arr\map;

/**
 * A key-value map class that provides a fluent interface for managing key-value pairs.
 *
 * Implements ArrayAccess, IteratorAggregate, and Countable for array-like behavior. Stores pairs as arrays with 'key' and 'value' fields.
 *
 * @example
 * ```php
 * $map = new Map([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
 * $map->put('c', 3); // Map contains [['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2], ['key' => 'c', 'value' => 3]]
 * ```
 */
class Map implements ArrayAccess, IteratorAggregate, Countable
{
    /**
     * The underlying array storing the map's key-value pairs.
     *
     * @var array
     */
    protected array $items;

    /**
     * Constructs a new Map instance from an array of key-value pairs.
     *
     * Each pair must be an array with 'key' and 'value' fields or a numeric array with key at index 0 and value at index 1.
     *
     * @param array|null $init The initial array of key-value pairs. Defaults to an empty array.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
     * // Initializes with [['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]
     * $map = new Map([['a', 1], ['b', 2]]); // Same result
     * $empty = new Map(); // Initializes with []
     * ```
     */
    public function __construct(?array $init = [])
    {
        $this->items = [];
        foreach ($init as $pair) {
            if (isset($pair['key'])) {
                $this->put($pair['key'], $pair['value']);
            } else {
                $this->put($pair[0], $pair[1]);
            }
        }
    }

    /**
     * Creates a new Map instance from an array of key-value pairs.
     *
     * Each item must be an array with 'key' and 'value' fields.
     *
     * @param array $items The array of key-value pairs to initialize the map.
     * @return static A new Map instance.
     * @example
     * ```php
     * $map = Map::from([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
     * // Creates a map with [['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]
     * ```
     */
    public static function from(array $items): static
    {
        $map = new static();

        foreach ($items as $item) {
            $map->put($item['key'], $item['value']);
        }

        return $map;
    }

    /**
     * Returns the map's items as an array of key-value pairs.
     *
     * @return array The array of key-value pairs, where each pair is an array with 'key' and 'value' fields.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1]]);
     * $array = $map->to_array(); // Returns [['key' => 'a', 'value' => 1]]
     * ```
     */
    public function to_array(): array
    {
        return array_values($this->items);
    }

    /**
     * Adds a key-value pair to the map if the key does not already exist.
     *
     * @param mixed $key The key for the value.
     * @param mixed $value The value to associate with the key.
     * @return static Returns the map instance for method chaining.
     * @example
     * ```php
     * $map = new Map();
     * $map->put('a', 1); // Map becomes [['key' => 'a', 'value' => 1]]
     * $map->put('a', 2); // Map unchanged, still [['key' => 'a', 'value' => 1]]
     * ```
     */
    public function put(mixed $key, mixed $value): static
    {
        if (!$this->offsetExists($key)) {
            $this->items[] = ['key' => $key, 'value' => $value];
        }

        return $this;
    }

    /**
     * Removes key-value pairs from the map that satisfy a condition.
     *
     * @param callable $condition Callback to test each pair. Receives the pair array (with 'key' and 'value') as parameter.
     * @return static Returns the map instance for method chaining.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
     * $map->forget(fn($pair) => $pair['value'] > 1); // Map becomes [['key' => 'a', 'value' => 1]]
     * ```
     */
    public function forget(callable $condition): static
    {
        $this->items = forget($this->items, $condition);

        return $this;
    }

    /**
     * Sets or updates a key-value pair in the map.
     *
     * If the key exists, its value is updated; otherwise, a new pair is added.
     *
     * @param mixed $key The key for the value.
     * @param mixed $value The value to set.
     * @return static Returns the map instance for method chaining.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1]]);
     * $map->set('a', 2); // Map becomes [['key' => 'a', 'value' => 2]]
     * $map->set('b', 3); // Map becomes [['key' => 'a', 'value' => 2], ['key' => 'b', 'value' => 3]]
     * ```
     */
    public function set(mixed $key, mixed $value): static
    {
        $index = first_key($this->items, fn ($pair) => $this->are_equal($key, $pair['key']));

        if (is_null($index)) {
            $this->items[] = ['key' => $key, 'value' => $value];
        } else {
            $this->items[$index]['value'] = $value;
        }

        return $this;
    }

    /**
     * Updates the value for a key if it exists in the map.
     *
     * If the key does not exist, the map is unchanged.
     *
     * @param mixed $key The key to update.
     * @param mixed $value The new value.
     * @return static Returns the map instance for method chaining.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1]]);
     * $map->swap('a', 2); // Map becomes [['key' => 'a', 'value' => 2]]
     * $map->swap('b', 3); // Map unchanged
     * ```
     */
    public function swap(mixed $key, mixed $value): static
    {
        $index = first_key($this->items, fn ($pair) => $this->are_equal($key, $pair['key']));

        if (!is_null($index)) {
            $this->items[$index]['value'] = $value;
        }

        return $this;
    }

    /**
     * Maps the map's values using a callback function.
     *
     * The callback is applied to each value, with the key passed as the second parameter.
     *
     * @param callable $callback Callback to apply to each value. Receives value and key as parameters.
     * @return static Returns the map instance with mapped values.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
     * $map->map(fn($value) => $value * 2); // Map becomes [['key' => 'a', 'value' => 2], ['key' => 'b', 'value' => 4]]
     * ```
     */
    public function map(callable $callback): static
    {
        $items = map($this, fn (array $pair) => $callback($pair['value'], $pair['key']));
        foreach ($this->items as $index => $item) {
            $this->items[$index]['value'] = $items[$index];
        }

        return $this;
    }

    /**
     * Checks if a key exists in the map.
     *
     * @param mixed $offset The key to check.
     * @return bool True if the key exists, false otherwise.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1]]);
     * $exists = isset($map['a']); // Returns true
     * $exists = isset($map['b']); // Returns false
     * ```
     */
    public function offsetExists(mixed $offset): bool
    {
        return has($this->items, fn (array $pair) => $this->are_equal($offset, $pair['key']));
    }

    /**
     * Retrieves the value associated with a key.
     *
     * @param mixed $offset The key to retrieve.
     * @return mixed The value associated with the key.
     * @throws OutOfBoundsException If the key does not exist in the map.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1]]);
     * $value = $map['a']; // Returns 1
     * $value = $map['b']; // Throws OutOfBoundsException
     * ```
     */
    public function offsetGet(mixed $offset): mixed
    {
        $pair = first($this->items, fn (array $pair) => $this->are_equal($offset, $pair['key']));

        if ($pair === null) {
            throw new OutOfBoundsException("Key `$offset` not found in map.");
        }

        return $pair['value'];
    }

    /**
     * Adds a key-value pair to the map if the key does not exist.
     *
     * @param mixed $offset The key to set.
     * @param mixed $value The value to set.
     * @return void
     * @example
     * ```php
     * $map = new Map();
     * $map['a'] = 1; // Map becomes [['key' => 'a', 'value' => 1]]
     * ```
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->put($offset, $value);
    }

    /**
     * Removes a key-value pair from the map by key.
     *
     * @param mixed $offset The key to remove.
     * @return void
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
     * unset($map['a']); // Map becomes [['key' => 'b', 'value' => 2]]
     * ```
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->forget(fn ($pair) => $this->are_equal($offset, $pair['key']));
    }

    /**
     * Returns an iterator for the map's items.
     *
     * @return Traversable An iterator for the map's key-value pairs.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1]]);
     * foreach ($map->getIterator() as $pair) {
     *     echo $pair['value']; // Outputs 1
     * }
     * ```
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Counts the number of key-value pairs in the map.
     *
     * @return int The number of key-value pairs.
     * @example
     * ```php
     * $map = new Map([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]]);
     * $count = $map->count(); // Returns 2
     * $count = count($map); // Returns 2
     * ```
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Compares two keys for equality using loose comparison.
     *
     * Developers can extend this class and override this method to implement custom comparison logic, such as strict equality.
     *
     * @param mixed $key1 The first key to compare.
     * @param mixed $key2 The second key to compare.
     * @return bool True if the keys are equal, false otherwise.
     * @example
     * ```php
     * $map = new Map();
     * // Internal usage, not typically called directly
     * $result = $map->are_equal('a', 'a'); // Returns true
     * $result = $map->are_equal('a', 'b'); // Returns false
     * ```
     */
    protected function are_equal(mixed $key1, mixed $key2): bool
    {
        return $key1 == $key2;
    }
}
