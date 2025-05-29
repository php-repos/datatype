<?php

namespace PhpRepos\Datatype;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use function PhpRepos\Datatype\Arr\first_key;
use function PhpRepos\Datatype\Arr\forget;
use function PhpRepos\Datatype\Arr\has;
use function PhpRepos\Datatype\Arr\map;
use function PhpRepos\Datatype\Arr\merge;

/**
 * A set class that provides a fluent interface for managing a unique collection of values.
 *
 * Implements ArrayAccess, IteratorAggregate, and Countable for array-like behavior. Ensures uniqueness of values using loose equality.
 *
 * @example
 * ```php
 * $set = new Set([1, 2, 2, 3]);
 * $set->add(4); // Set contains [1, 2, 3, 4]
 * ```
 */
class Set implements ArrayAccess, IteratorAggregate, Countable
{
    /**
     * The underlying array storing the set's unique items.
     *
     * @var array
     */
    protected array $items;

    /**
     * Constructs a new Set instance from an array of values.
     *
     * Duplicate values are automatically removed based on loose equality.
     *
     * @param array|null $init The initial array of values. Defaults to an empty array.
     * @example
     * ```php
     * $set = new Set([1, 2, 2, 3]); // Initializes with [1, 2, 3]
     * $empty = new Set(); // Initializes with []
     * ```
     */
    public function __construct(?array $init = [])
    {
        $this->items = [];
        foreach ($init as $item) {
            $this->add($item);
        }
    }

    /**
     * Creates a new Set instance from an array of values.
     *
     * @param array|null $init The array of values to initialize the set.
     * @return static A new Set instance.
     * @example
     * ```php
     * $set = Set::from([1, 2, 2, 3]); // Creates a set with [1, 2, 3]
     * ```
     */
    public static function from(?array $init): static
    {
        return new static($init);
    }

    /**
     * Creates a new Set instance with a range of values.
     *
     * @param float|int|string $start The start of the range.
     * @param float|int|string $end The end of the range.
     * @param int|float $step The step increment. Defaults to 1.
     * @return static A new Set instance with the range of values.
     * @example
     * ```php
     * $set = Set::range(1, 3); // Creates a set with [1, 2, 3]
     * $set = Set::range(1, 5, 2); // Creates a set with [1, 3, 5]
     * ```
     */
    public static function range(float|int|string $start, float|int|string $end, int|float $step = 1): static
    {
        return static::from(range($start, $end, $step));
    }

    /**
     * Creates a new Set instance containing the lowercase alphabet (a-z).
     *
     * @return static A new Set instance with letters 'a' to 'z'.
     * @example
     * ```php
     * $set = Set::alphabet(); // Creates a set with ['a', 'b', ..., 'z']
     * ```
     */
    public static function alphabet(): static
    {
        return static::range('a', 'z');
    }

    /**
     * Returns the set's items as an array.
     *
     * @return array The array of unique values.
     * @example
     * ```php
     * $set = new Set([1, 2, 2, 3]);
     * $array = $set->to_array(); // Returns [1, 2, 3]
     * ```
     */
    public function to_array(): array
    {
        return array_values($this->items);
    }

    /**
     * Adds one or more values to the set if they are not already present.
     *
     * @param mixed ...$values The values to add.
     * @return static Returns the set instance for method chaining.
     * @example
     * ```php
     * $set = new Set([1, 2]);
     * $set->add(2, 3); // Set becomes [1, 2, 3]
     * ```
     */
    public function add(mixed ...$values): static
    {
        foreach ($values as $value) {
            if (! has($this->items, fn (mixed $item) => $this->are_equal($value, $item))) {
                $this->items[] = $value;
            }
        }

        return $this;
    }

    /**
     * Removes one or more values from the set.
     *
     * @param mixed ...$values The values to remove.
     * @return static Returns the set instance for method chaining.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * $set->remove(2); // Set becomes [1, 3]
     * ```
     */
    public function remove(mixed ...$values): static
    {
        foreach ($values as $value) {
            $key = first_key($this, fn (mixed $item) => $this->are_equal($item, $value));

            if ($key !== null) {
                unset($this->items[$key]);
            }
        }

        return $this;
    }

    /**
     * Removes items from the set that satisfy a condition.
     *
     * @param callable $condition Callback to test each item. Receives the item as a parameter.
     * @return static Returns the set instance for method chaining.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * $set->forget(fn($item) => $item > 1); // Set becomes [1]
     * ```
     */
    public function forget(callable $condition): static
    {
        $this->items = forget($this, $condition);

        return $this;
    }

    /**
     * Clears all items from the set.
     *
     * @return static Returns the set instance for method chaining.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * $set->clear(); // Set becomes []
     * ```
     */
    public function clear(): static
    {
        $this->items = [];

        return $this;
    }

    /**
     * Maps the set's items using a callback function.
     *
     * @param callable $callback Callback to apply to each item. Receives the item as a parameter.
     * @return static Returns the set instance with mapped items.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * $set->map(fn($item) => $item * 2); // Set becomes [2, 4, 6]
     * ```
     */
    public function map(callable $callback): static
    {
        $this->items = map($this, fn (mixed $item) => $callback($item));

        return $this;
    }

    /**
     * Merges multiple iterables into the current set, ensuring unique values.
     *
     * Combines the elements of the provided iterables with the set's items, preserving uniqueness based on loose equality
     * as defined in are_equal. Each iterable is converted to an array using Arr\to_array, merged using Arr\merge, and
     * added to the set. Override are_equal to customize comparison logic.
     *
     * @param iterable ...$arrays The iterables to merge (arrays, ArrayAccess, or objects with to_array method).
     * @return static Returns the set instance for method chaining.
     * @example
     * ```php
     * $set = Set::from([1, 2]);
     * $set->merge([2, 3], new ArrayIterator([3, 4]));
     * // Set now contains [1, 2, 3, 4]
     * ```
     */
    public function merge(iterable ...$arrays): static
    {
        $this->add(...merge(...$arrays));

        return $this;
    }

    /**
     * Checks if an offset exists in the set.
     *
     * @param mixed $offset The offset to check.
     * @return bool True if the offset exists, false otherwise.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * isset($set[0]); // Returns true
     * isset($set[3]; // Returns false
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
     * $set = new Set([1, 2, 3]);
     * $value = $set[0]; // Returns 1
     * ```
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    /**
     * Sets a value at a specific offset if the value is not already present in the set.
     *
     * @param mixed $offset The offset to set.
     * @param mixed $value The value to set.
     * @return void
     * @example
     * ```php
     * $set = new Set([1, 2]);
     * $set[2] = 3; // Set becomes [1, 2, 3]
     * $set[3] = 2; // Set unchanged (2 already exists)
     * ```
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!has($this->items, fn (mixed $item) => $this->are_equal($item, $value))) {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Unsets a value at a specific offset.
     *
     * @param mixed $offset The offset to unset.
     * @return void
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * unset($set[0]); // Set becomes [2, 3]
     * ```
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * Returns an iterator for the set's items.
     *
     * @return Traversable An iterator for the set's items.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * foreach ($set->getIterator() as $item) {
     *     echo $item; // Outputs 1, 2, 3
     * }
     * ```
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Counts the number of items in the set.
     *
     * @return int The number of items in the set.
     * @example
     * ```php
     * $set = new Set([1, 2, 3]);
     * $count = $set->count(); // Returns 3
     * $count = count($set); // Returns 3
     * ```
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Compares two values for equality using loose comparison.
     *
     * @param mixed $value1 The first value to compare.
     * @param mixed $value2 The second value to compare.
     * @return bool True if the values are equal, false otherwise.
     * @example
     * ```php
     * $set = new Set();
     * // Internal usage, not typically called directly
     * $result = $set->are_equal(1, '1'); // Returns true
     * $result = $set->are_equal(1, 2); // Returns false
     * ```
     */
    protected function are_equal(mixed $value1, mixed $value2): bool
    {
        return $value1 == $value2;
    }
}
