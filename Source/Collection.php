<?php

namespace PhpRepos\Datatype;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use function PhpRepos\Datatype\Arr\forget;
use function PhpRepos\Datatype\Arr\map;
use function PhpRepos\Datatype\Arr\merge;
use function PhpRepos\Datatype\Arr\take_first;

/**
 * A collection class that provides a fluent interface for working with arrays.
 *
 * Implements ArrayAccess, IteratorAggregate, and Countable for array-like behavior.
 *
 * @example
 * ```php
 * $collection = new Collection([1, 2, 3]);
 * $collection->push(4)->put('key', 5); // Collection with [1, 2, 3, 4, 'key' => 5]
 * ```
 */
class Collection implements ArrayAccess, IteratorAggregate, Countable
{
    /**
     * The underlying array storing the collection's items.
     *
     * @var array
     */
    protected array $items;

    /**
     * Constructs a new Collection instance.
     *
     * @param array|null $init The initial array to populate the collection. Defaults to an empty array.
     * @example
     * ```php
     * $collection = new Collection(['a' => 1, 'b' => 2]); // Initializes with ['a' => 1, 'b' => 2]
     * $empty = new Collection(); // Initializes with []
     * ```
     */
    public function __construct(?array $init = [])
    {
        $this->items = $init;
    }

    /**
     * Removes elements from the collection that satisfy a condition.
     *
     * @param callable $condition Callback to test each element. Receives value and key as parameters.
     * @return static Returns the collection instance for method chaining.
     * @example
     * ```php
     * $collection = new Collection([1, 2, 3]);
     * $collection->forget(fn($value) => $value > 1); // Collection becomes [0 => 1]
     * ```
     */
    function forget(callable $condition): static
    {
        $this->items = forget($this, $condition);

        return $this;
    }

    /**
     * Creates a new Collection instance from an array.
     *
     * @param array $init The initial array to populate the collection.
     * @return static A new Collection instance.
     * @example
     * ```php
     * $collection = Collection::make([1, 2, 3]); // Creates a collection with [1, 2, 3]
     * ```
     */
    public static function make(array $init): static
    {
        return new static($init);
    }

    /**
     * Maps the collection's items using a callback function.
     *
     * @param callable $callback Callback to apply to each element. Receives value and key as parameters.
     * @return static Returns the collection instance with mapped items.
     * @example
     * ```php
     * $collection = new Collection([1, 2, 3]);
     * $collection->map(fn($value) => $value * 2); // Collection becomes [2, 4, 6]
     * ```
     */
    public function map(callable $callback): static
    {
        $this->items = map($this, $callback);

        return $this;
    }

    /**
     * Adds a value to the collection, optionally with a specific key.
     *
     * If no key is provided, the value is appended to the collection.
     *
     * @param mixed $value The value to add.
     * @param mixed|null $key Optional key for the value. If null, the value is appended.
     * @return static Returns the collection instance for method chaining.
     * @example
     * ```php
     * $collection = new Collection();
     * $collection->put(1); // Collection becomes [0 => 1]
     * $collection->put(2, 'key'); // Collection becomes [0 => 1, 'key' => 2]
     * ```
     */
    public function put(mixed $value, mixed $key = null): static
    {
        $key === null ? $this->push($value) : $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * Appends one or more values to the collection.
     *
     * @param mixed ...$values The values to append.
     * @return static Returns the collection instance for method chaining.
     * @example
     * ```php
     * $collection = new Collection([1]);
     * $collection->push(2, 3); // Collection becomes [1, 2, 3]
     * ```
     */
    public function push(mixed ...$values): static
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }

    /**
     * Sets a value at a specific offset, overwriting any existing value.
     *
     * @param mixed $offset The key/offset to set.
     * @param mixed $value The value to set.
     * @return static Returns the collection instance for method chaining.
     * @example
     * ```php
     * $collection = new Collection(['a' => 1]);
     * $collection->set('a', 2); // Collection becomes ['a' => 2]
     * $collection->set('b', 3); // Collection becomes ['a' => 2, 'b' => 3]
     * ```
     */
    public function set(mixed $offset, mixed $value): static
    {
        $this->items[$offset] = $value;

        return $this;
    }

    /**
     * Merges multiple iterables into the current collection.
     *
     * Combines the elements of the provided iterables with the collection's items, preserving keys for associative arrays
     * and reindexing numeric keys. Each iterable is converted to an array using Arr\to_array before merging.
     * The collection's items are replaced with the merged result.
     *
     * @param iterable ...$arrays The iterables to merge (arrays, ArrayAccess, or objects with to_array method).
     * @return static Returns the collection instance for method chaining.
     * @example
     * ```php
     * $collection = Collection::make([1, 2]);
     * $collection->merge(['a' => 3, 4], new ArrayIterator([5]));
     * // Collection now contains [1, 2, 'a' => 3, 4, 5]
     * ```
     */
    public function merge(iterable ...$arrays): static
    {
        $this->items = merge($this, ...$arrays);

        return $this;
    }

    /**
     * Removes and returns the first element in the collection that satisfies a condition.
     *
     * @param callable $condition Callback to test each element. Receives value and key as parameters.
     * @return mixed The first value that matches the condition, or null if none found.
     * @example
     * ```php
     * $collection = new Collection([1, 2, 3]);
     * $value = $collection->take_first(fn($value) => $value > 1); // Returns 2, collection becomes [0 => 1, 2 => 3]
     * ```
     */
    public function take_first(callable $condition): mixed
    {
        $items = $this->to_array();
        $first = take_first($items, $condition);
        $this->items = $items;

        return $first;
    }

    /**
     * Returns the collection's items as an array.
     *
     * @return array The underlying array of items.
     * @example
     * ```php
     * $collection = new Collection(['a' => 1, 'b' => 2]);
     * $array = $collection->to_array(); // Returns ['a' => 1, 'b' => 2]
     * ```
     */
    public function to_array(): array
    {
        return $this->items;
    }

    /**
     * Counts the number of items in the collection.
     *
     * @return int The number of items in the collection.
     * @example
     * ```php
     * $collection = new Collection([1, 2, 3]);
     * $count = $collection->count(); // Returns 3
     * $count = count($collection); // Returns 3
     * ```
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Returns an iterator for the collection.
     *
     * @return Traversable An iterator for the collection's items.
     * @example
     * ```php
     * $collection = new Collection([1, 2, 3]);
     * foreach ($collection->getIterator() as $value) {
     *     echo $value; // Outputs 1, 2, 3
     * }
     * ```
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Checks if an offset exists in the collection.
     *
     * @param mixed $offset The offset to check.
     * @return bool True if the offset exists, false otherwise.
     * @example
     * ```php
     * $collection = new Collection(['a' => 1]);
     * isset($collection['a']); // Returns true
     * isset($collection['b']); // Returns false
     * ```
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * Retrieves the value at a specific offset.
     *
     * @param mixed $offset The offset to retrieve.
     * @return mixed The value at the specified offset.
     * @example
     * ```php
     * $collection = new Collection(['a' => 1]);
     * $value = $collection['a']; // Returns 1
     * ```
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    /**
     * Sets a value at a specific offset.
     *
     * @param mixed $offset The offset to set.
     * @param mixed $value The value to set.
     * @return void
     * @example
     * ```php
     * $collection = new Collection();
     * $collection['a'] = 1; // Collection becomes ['a' => 1]
     * ```
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    /**
     * Unsets a value at a specific offset.
     *
     * @param mixed $offset The offset to unset.
     * @return void
     * @example
     * ```php
     * $collection = new Collection(['a' => 1, 'b' => 2]);
     * unset($collection['a']); // Collection becomes ['b' => 2]
     * ```
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }
}
