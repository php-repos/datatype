# Datatype Package API Reference

This document provides a detailed reference for all functions, methods, and classes in the `datatype` package for `phpkg`. For an overview, installation instructions, and usage examples, see the [README.md](README.md).

The `datatype` package, under the `PhpRepos\Datatype` namespace, offers utilities for array and string manipulation, including fluent collections, key-value maps, sets, and string operations with UTF-8 support.

## Table of Contents
- [Arr](#arr)
- [Collection](#collection)
- [Map](#map)
- [Set](#set)
- [Str](#str)
- [Text](#text)

## Arr
The `Arr` component provides helper functions for array operations, supporting arrays, iterables, and objects with a `to_array` method.

- **to_array(mixed $input): array**
  - Converts a mixed input to an array.
  - **Parameters**: `$input` - Array, iterable, or object with `to_array` method.
  - **Throws**: `InvalidArgumentException` if input is invalid.
  - **Example**: `to_array(new ArrayIterator([1, 2, 3])) // [1, 2, 3]`

- **assert_equal(iterable $actual, iterable $expected, ?string $message = null): true**
  - Asserts two iterables are equal (same values in order).
  - **Parameters**: `$actual`, `$expected` - Iterables to compare; `$message` - Optional error message.
  - **Throws**: `AssertionError` if not equal.
  - **Example**: `assert_equal([1, 2], [1, 2]) // true`

- **assert_same(iterable $actual, iterable $expected, ?string $message = null): true**
  - Asserts two iterables are identical (same values and references).
  - **Parameters**: `$actual`, `$expected` - Iterables to compare; `$message` - Optional error message.
  - **Throws**: `AssertionError` if not identical.
  - **Example**: `$arr = [1, 2]; assert_same($arr, $arr) // true`

- **all(iterable $array, ?callable $condition = null): bool**
  - Checks if all elements satisfy a condition or are truthy.
  - **Parameters**: `$array` - Iterable to check; `$condition` - Optional callback (value, key).
  - **Example**: `all([1, 2, 3], fn($v) => $v > 0) // true`

- **any(iterable $array, ?callable $condition = null): bool**
  - Checks if any element satisfies a condition or if non-empty.
  - **Parameters**: `$array` - Iterable to check; `$condition` - Optional callback (value, key).
  - **Example**: `any([1, 2, 3], fn($v) => $v > 2) // true`

- **cartesian_product(iterable $array): array**
  - Computes the Cartesian product of arrays.
  - **Parameters**: `$array` - Iterable of arrays.
  - **Example**: `cartesian_product([[1, 2], ['a', 'b']]) // [[1, 'a'], [1, 'b'], [2, 'a'], [2, 'b']]`

- **contains(iterable $array, mixed $value): bool**
  - Checks if a value exists in an iterable.
  - **Parameters**: `$array` - Iterable to check; `$value` - Value to search for.
  - **Example**: `contains([1, 2, 3], 2) // true`

- **first_key(iterable $array, ?callable $condition = null): string|int|null**
  - Returns the first key satisfying a condition or the first key.
  - **Parameters**: `$array` - Iterable to search; `$condition` - Optional callback (value, key).
  - **Example**: `first_key(['a' => 1, 'b' => 2], fn($v) => $v > 1) // 'b'`

- **first(iterable $array, ?callable $condition = null): mixed**
  - Returns the first value satisfying a condition or the first value.
  - **Parameters**: `$array` - Iterable to search; `$condition` - Optional callback (value, key).
  - **Example**: `first(['a' => 1, 'b' => 2], fn($v) => $v > 1) // 2`

- **forget(iterable $array, callable $condition): array**
  - Removes elements satisfying a condition.
  - **Parameters**: `$array` - Iterable to process; `$condition` - Callback (value, key).
  - **Example**: `forget(['a' => 1, 'b' => 2], fn($v) => $v > 1) // ['a' => 1]`

- **has(iterable $array, callable $callable): bool**
  - Checks if any element satisfies a condition.
  - **Parameters**: `$array` - Iterable to check; `$callable` - Callback (value, key).
  - **Example**: `has([1, 2, 3], fn($v) => $v > 2) // true`

- **filter(iterable $array, ?callable $callback = null): array**
  - Filters elements based on a callback or truthy values.
  - **Parameters**: `$array` - Iterable to filter; `$callback` - Optional callback (value, key).
  - **Example**: `filter([1, 0, 3], fn($v) => $v > 0) // [1, 3]`

- **insert_after(iterable $array, mixed $key, iterable $additional): array**
  - Inserts elements after a key.
  - **Parameters**: `$array` - Input iterable; `$key` - Key to insert after; `$additional` - Elements to insert.
  - **Example**: `insert_after(['a' => 1, 'b' => 2], 'a', ['x' => 10]) // ['a' => 1, 'x' => 10, 'b' => 2]`

- **last_key(iterable $array, ?callable $condition = null): string|int|null**
  - Returns the last key satisfying a condition or the last key.
  - **Parameters**: `$array` - Iterable to search; `$condition` - Optional callback (value, key).
  - **Example**: `last_key(['a' => 1, 'b' => 2], fn($v) => $v > 1) // 'b'`

- **last(iterable $array, ?callable $condition = null): mixed**
  - Returns the last value satisfying a condition or the last value.
  - **Parameters**: `$array` - Iterable to search; `$condition` - Optional callback (value, key).
  - **Example**: `last(['a' => 1, 'b' => 2], fn($v) => $v > 1) // 2`

- **map(iterable $array, callable $callback): array**
  - Maps elements using a callback.
  - **Parameters**: `$array` - Iterable to map; `$callback` - Callback (value, key).
  - **Example**: `map([1, 2, 3], fn($v) => $v * 2) // [2, 4, 6]`

- **max_key_length(iterable $array): int**
  - Returns the maximum length of keys.
  - **Parameters**: `$array` - Iterable to process.
  - **Example**: `max_key_length(['abc' => 1, 'de' => 2]) // 3`

- **reduce(iterable $array, callable $callback, mixed $carry = null): mixed**
  - Reduces an iterable to a single value.
  - **Parameters**: `$array` - Iterable to reduce; `$callback` - Callback (carry, value, key); `$carry` - Initial value.
  - **Example**: `reduce([1, 2, 3], fn($carry, $v) => $carry + $v, 0) // 6`

- **take_first(array &$array, callable $condition): mixed**
  - Removes and returns the first element satisfying a condition.
  - **Parameters**: `$array` - Array to process (modified); `$condition` - Callback (value, key).
  - **Example**: `$array = ['a' => 1, 'b' => 2]; take_first($array, fn($v) => $v > 1) // 2, $array = ['a' => 1]`

## Collection
A fluent array wrapper implementing `ArrayAccess`, `IteratorAggregate`, and `Countable`.

- **__construct(?array $init = [])**
  - Initializes with an optional array.
  - **Parameters**: `$init` - Initial array.
  - **Example**: `new Collection([1, 2, 3])`

- **make(array $init): static**
  - Creates a new instance.
  - **Parameters**: `$init` - Initial array.
  - **Example**: `Collection::make([1, 2, 3])`

- **forget(callable $condition): static**
  - Removes elements satisfying a condition.
  - **Parameters**: `$condition` - Callback (value, key).
  - **Example**: `$collection->forget(fn($v) => $v > 1) // [1]`

- **map(callable $callback): static**
  - Maps elements using a callback.
  - **Parameters**: `$callback` - Callback (value, key).
  - **Example**: `$collection->map(fn($v) => $v * 2) // [2, 4, 6]`

- **put(mixed $value, mixed $key = null): static**
  - Adds a value, optionally with a key.
  - **Parameters**: `$value` - Value to add; `$key` - Optional key.
  - **Example**: `$collection->put(1) // [1]; $collection->put(2, 'a') // ['a' => 2]`

- **push(mixed ...$values): static**
  - Appends values.
  - **Parameters**: `$values` - Values to append.
  - **Example**: `$collection->push(1, 2) // [1, 2]`

- **set(mixed $offset, mixed $value): static**
  - Sets a value at an offset, overwriting existing.
  - **Parameters**: `$offset` - Key; `$value` - Value.
  - **Example**: `$collection->set('a', 1) // ['a' => 1]`

- **take_first(callable $condition): mixed**
  - Removes and returns the first element satisfying a condition.
  - **Parameters**: `$condition` - Callback (value, key).
  - **Example**: `$collection->take_first(fn($v) => $v > 1) // 2`

- **to_array(): array**
  - Returns the underlying array.
  - **Example**: `$collection->to_array() // [1, 2, 3]`

- **count(): int**
  - Counts items.
  - **Example**: `$collection->count() // 3`

- **getIterator(): Traversable**
  - Returns an iterator.
  - **Example**: `foreach ($collection->getIterator() as $v) { /* ... */ }`

- **offsetExists(mixed $offset): bool**
  - Checks if an offset exists.
  - **Parameters**: `$offset` - Key to check.
  - **Example**: `$collection->offsetExists('a') // true`

- **offsetGet(mixed $offset): mixed**
  - Retrieves a value by offset.
  - **Parameters**: `$offset` - Key to retrieve.
  - **Example**: `$collection->offsetGet('a') // 1`

- **offsetSet(mixed $offset, mixed $value): void**
  - Sets a value at an offset.
  - **Parameters**: `$offset` - Key; `$value` - Value.
  - **Example**: `$collection->offsetSet('a', 1)`

- **offsetUnset(mixed $offset): void**
  - Unsets a value by offset.
  - **Parameters**: `$offset` - Key to unset.
  - **Example**: `$collection->offsetUnset('a')`

## Map
A key-value store with unique keys, implementing `ArrayAccess`, `IteratorAggregate`, and `Countable`.

- **__construct(?array $init = [])**
  - Initializes with key-value pairs.
  - **Parameters**: `$init` - Array of pairs (`['key' => $key, 'value' => $value]` or `[$key, $value]`).
  - **Example**: `new Map([['key' => 'a', 'value' => 1]])`

- **from(array $items): static**
  - Creates a new instance from pairs.
  - **Parameters**: `$items` - Array of pairs with `key` and `value`.
  - **Example**: `Map::from([['key' => 'a', 'value' => 1]])`

- **to_array(): array**
  - Returns the array of key-value pairs.
  - **Example**: `$map->to_array() // [['key' => 'a', 'value' => 1]]`

- **put(mixed $key, mixed $value): static**
  - Adds a pair if the key doesn’t exist.
  - **Parameters**: `$key` - Key; `$value` - Value.
  - **Example**: `$map->put('a', 1) // [['key' => 'a', 'value' => 1]]`

- **forget(callable $condition): static**
  - Removes pairs satisfying a condition.
  - **Parameters**: `$condition` - Callback (pair array).
  - **Example**: `$map->forget(fn($pair) => $pair['value'] > 1)`

- **set(mixed $key, mixed $value): static**
  - Sets or updates a pair.
  - **Parameters**: `$key` - Key; `$value` - Value.
  - **Example**: `$map->set('a', 2) // Updates or adds 'a' => 2`

- **swap(mixed $key, mixed $value): static**
  - Updates a value if the key exists.
  - **Parameters**: `$key` - Key; `$value` - New value.
  - **Example**: `$map->swap('a', 2) // Updates 'a' to 2 if exists`

- **map(callable $callback): static**
  - Maps values using a callback.
  - **Parameters**: `$callback` - Callback (value, key).
  - **Example**: `$map->map(fn($v) => $v * 2)`

- **offsetExists(mixed $offset): bool**
  - Checks if a key exists.
  - **Parameters**: `$offset` - Key to check.
  - **Example**: `$map->offsetExists('a') // true`

- **offsetGet(mixed $offset): mixed**
  - Retrieves a value by key.
  - **Parameters**: `$offset` - Key to retrieve.
  - **Throws**: `OutOfBoundsException` if key not found.
  - **Example**: `$map->offsetGet('a') // 1`

- **offsetSet(mixed $offset, mixed $value): void**
  - Adds a pair if the key doesn’t exist.
  - **Parameters**: `$offset` - Key; `$value` - Value.
  - **Example**: `$map->offsetSet('a', 1)`

- **offsetUnset(mixed $offset): void**
  - Removes a pair by key.
  - **Parameters**: `$offset` - Key to remove.
  - **Example**: `$map->offsetUnset('a')`

- **getIterator(): Traversable**
  - Returns an iterator.
  - **Example**: `foreach ($map->getIterator() as $pair) { /* ... */ }`

- **count(): int**
  - Counts pairs.
  - **Example**: `$map->count() // 2`

- **are_equal(mixed $key1, mixed $key2): bool** (protected)
  - Compares keys using loose equality (extensible).
  - **Parameters**: `$key1`, `$key2` - Keys to compare.
  - **Example**: Extend class to override for strict equality.

## Set
A collection of unique values, implementing `ArrayAccess`, `IteratorAggregate`, and `Countable`.

- **__construct(?array $init = [])**
  - Initializes with unique values.
  - **Parameters**: `$init` - Initial array.
  - **Example**: `new Set([1, 2, 2]) // [1, 2]`

- **from(?array $init): static**
  - Creates a new instance.
  - **Parameters**: `$init` - Initial array.
  - **Example**: `Set::from([1, 2, 2])`

- **range(float|int|string $start, float|int|string $end, int|float $step = 1): static**
  - Creates a set with a range of values.
  - **Parameters**: `$start`, `$end` - Range bounds; `$step` - Increment.
  - **Example**: `Set::range(1, 3) // [1, 2, 3]`

- **alphabet(): static**
  - Creates a set of lowercase alphabet letters.
  - **Example**: `Set::alphabet() // ['a', 'b', ..., 'z']`

- **to_array(): array**
  - Returns the array of unique values.
  - **Example**: `$set->to_array() // [1, 2, 3]`

- **add(mixed ...$values): static**
  - Adds values if not present.
  - **Parameters**: `$values` - Values to add.
  - **Example**: `$set->add(1, 2, 2) // [1, 2]`

- **remove(mixed ...$values): static**
  - Removes values.
  - **Parameters**: `$values` - Values to remove.
  - **Example**: `$set->remove(1) // [2, 3]`

- **forget(callable $condition): static**
  - Removes items satisfying a condition.
  - **Parameters**: `$condition` - Callback (item).
  - **Example**: `$set->forget(fn($v) => $v > 1)`

- **clear(): static**
  - Clears all items.
  - **Example**: `$set->clear() // []`

- **map(callable $callback): static**
  - Maps items using a callback.
  - **Parameters**: `$callback` - Callback (item).
  - **Example**: `$set->map(fn($v) => $v * 2)`

- **offsetExists(mixed $offset): bool**
  - Checks if an offset exists.
  - **Parameters**: `$offset` - Offset to check.
  - **Example**: `$set->offsetExists(0) // true`

- **offsetGet(mixed $offset): mixed**
  - Retrieves a value by offset.
  - **Parameters**: `$offset` - Offset to retrieve.
  - **Example**: `$set->offsetGet(0) // 1`

- **offsetSet(mixed $offset, mixed $value): void**
  - Sets a value if not present.
  - **Parameters**: `$offset` - Offset; `$value` - Value.
  - **Example**: `$set->offsetSet(2, 3)`

- **offsetUnset(mixed $offset): void**
  - Unsets a value by offset.
  - **Parameters**: `$offset` - Offset to unset.
  - **Example**: `$set->offsetUnset(0)`

- **getIterator(): Traversable**
  - Returns an iterator.
  - **Example**: `foreach ($set->getIterator() as $v) { /* ... */ }`

- **count(): int**
  - Counts items.
  - **Example**: `$set->count() // 3`

- **are_equal(mixed $value1, mixed $value2): bool** (protected)
  - Compares values using loose equality (extensible).
  - **Parameters**: `$value1`, `$value2` - Values to compare.
  - **Example**: Extend class to override for strict equality.

## Str
String manipulation functions with UTF-8 support, handling `string` and `Stringable`.

- **assert_equal(string|Stringable $actual, string|Stringable $expected, ?string $message = null): true**
  - Asserts strings are equal after conversion.
  - **Parameters**: `$actual`, `$expected` - Strings to compare; `$message` - Optional error message.
  - **Throws**: `AssertionError` if not equal.
  - **Example**: `assert_equal('hello', 'hello') // true`

- **assert_same(string|Stringable $actual, string|Stringable $expected, ?string $message = null): true**
  - Asserts strings are identical.
  - **Parameters**: `$actual`, `$expected` - Strings to compare; `$message` - Optional error message.
  - **Throws**: `AssertionError` if not identical.
  - **Example**: `$str = 'hello'; assert_same($str, $str) // true`

- **after(string $subject, int $position): string**
  - Returns substring from position to end.
  - **Parameters**: `$subject` - String; `$position` - Start position.
  - **Example**: `after('hello', 2) // 'llo'`

- **after_first_occurrence(string $subject, string $needle): string**
  - Returns substring after first needle occurrence.
  - **Parameters**: `$subject`, `$needle` - Strings.
  - **Example**: `after_first_occurrence('hello world', ' ') // 'world'`

- **after_last_occurrence(string $subject, string $needle): string**
  - Returns substring after last needle occurrence.
  - **Parameters**: `$subject`, `$needle` - Strings.
  - **Example**: `after_last_occurrence('hello world hello', ' ') // 'hello'`

- **before(string $subject, int $position): string**
  - Returns substring from start to position.
  - **Parameters**: `$subject` - String; `$position` - End position.
  - **Example**: `before('hello', 2) // 'he'`

- **before_first_occurrence(string $subject, string $needle): string**
  - Returns substring before first needle occurrence.
  - **Parameters**: `$subject`, `$needle` - Strings.
  - **Example**: `before_first_occurrence('hello world', ' ') // 'hello'`

- **before_last_occurrence(string $subject, string $needle): string**
  - Returns substring before last needle occurrence.
  - **Parameters**: `$subject`, `$needle` - Strings.
  - **Example**: `before_last_occurrence('hello world hello', ' ') // 'hello world'`

- **between(string $subject, string $start, string $end): string**
  - Returns substring between delimiters.
  - **Parameters**: `$subject`, `$start`, `$end` - Strings.
  - **Example**: `between('hello [world] end', '[', ']') // 'world'`

- **camel_case(string $subject): string**
  - Converts to camelCase.
  - **Parameters**: `$subject` - String.
  - **Example**: `camel_case('hello_world') // 'helloWorld'`

- **concat(string $suffix, ?string ...$subjects): string**
  - Concatenates strings with a separator.
  - **Parameters**: `$suffix` - Separator; `$subjects` - Strings to join.
  - **Example**: `concat('-', 'a', 'b', null) // 'a-b'`

- **first_character(string $subject): string**
  - Returns first character.
  - **Parameters**: `$subject` - String.
  - **Example**: `first_character('hello') // 'h'`

- **first_line(string $subject): string**
  - Returns first line, trimmed.
  - **Parameters**: `$subject` - String.
  - **Example**: `first_line("hello\nworld") // 'hello'`

- **last_character(string $subject): string**
  - Returns last character.
  - **Parameters**: `$subject` - String.
  - **Example**: `last_character('hello') // 'o'`

- **kebab_case(string $subject): string**
  - Converts to kebab-case.
  - **Parameters**: `$subject` - String.
  - **Example**: `kebab_case('helloWorld') // 'hello-world'`

- **pascal_case(string $subject): string**
  - Converts to PascalCase.
  - **Parameters**: `$subject` - String.
  - **Example**: `pascal_case('hello_world') // 'HelloWorld'`

- **prepend_when_exists(?string $subject, string $prefix): string**
  - Prepends prefix if subject is non-null.
  - **Parameters**: `$subject` - String or null; `$prefix` - Prefix.
  - **Example**: `prepend_when_exists('world', 'hello ') // 'hello world'`

- **remove_first_character(string $subject): string**
  - Removes first character.
  - **Parameters**: `$subject` - String.
  - **Example**: `remove_first_character('hello') // 'ello'`

- **remove_last_character(string $subject): string**
  - Removes last character.
  - **Parameters**: `$subject` - String.
  - **Example**: `remove_last_character('hello') // 'hell'`

- **replace_first_occurrence(string $subject, string $search, string $replace): string**
  - Replaces first occurrence.
  - **Parameters**: `$subject`, `$search`, `$replace` - Strings.
  - **Example**: `replace_first_occurrence('hello world', 'l', 'x') // 'hexlo world'`

- **snake_case(string $subject): string**
  - Converts to snake_case.
  - **Parameters**: `$subject` - String.
  - **Example**: `snake_case('helloWorld') // 'hello_world'`

- **starts_with_regex(string $subject, string $pattern): bool**
  - Checks if string starts with a regex pattern.
  - **Parameters**: `$subject`, `$pattern` - Strings.
  - **Example**: `starts_with_regex('hello world', 'he') // true`

- **words(string $subject, string $separators = " \t\r\n\f\v"): array**
  - Splits string into words.
  - **Parameters**: `$subject` - String; `$separators` - Separator characters.
  - **Example**: `words('hello world') // ['hello', 'world']`

## Text
A fluent string wrapper implementing `Stringable`.

- **__construct(?string $init = null)**
  - Initializes with an optional string.
  - **Parameters**: `$init` - String or null.
  - **Example**: `new Text('hello')`

- **from(?string $init): static**
  - Creates a new instance.
  - **Parameters**: `$init` - String or null.
  - **Example**: `Text::from('hello')`

- **string(): string**
  - Returns the underlying string.
  - **Example**: `$text->string() // 'hello'`

- **set(string $string): static**
  - Sets the string.
  - **Parameters**: `$string` - New string.
  - **Example**: `$text->set('world')`

- **append(string ...$subjects): static**
  - Appends strings without separator.
  - **Parameters**: `$subjects` - Strings to append.
  - **Example**: `$text->append(' world') // 'hello world'`

- **concat(string $suffix, ...$subjects): static**
  - Concatenates with a separator.
  - **Parameters**: `$suffix` - Separator; `$subjects` - Strings to join.
  - **Example**: `$text->concat('-', 'world') // 'hello-world'`

- **map(callable $callback): static**
  - Applies a callback to the string.
  - **Parameters**: `$callback` - Callback (Text object).
  - **Example**: `$text->map(fn($str) => strtoupper($str)) // 'HELLO'`

- **camel_case(): static**
  - Converts to camelCase.
  - **Example**: `$text->camel_case() // 'helloWorld'`

- **kebab_case(): static**
  - Converts to kebab-case.
  - **Example**: `$text->kebab_case() // 'hello-world'`

- **pascal_case(): static**
  - Converts to PascalCase.
  - **Example**: `$text->pascal_case() // 'HelloWorld'`

- **snake_case(): static**
  - Converts to snake_case.
  - **Example**: `$text->snake_case() // 'hello_world'`

- **remove_first_character(): static**
  - Removes first character.
  - **Example**: `$text->remove_first_character() // 'ello'`

- **remove_last_character(): static**
  - Removes last character.
  - **Example**: `$text->remove_last_character() // 'hell'`

- **__toString(): string**
  - Returns string representation.
  - **Example**: `echo $text; // 'hello'`

## Extensibility
Override `Map::are_equal` or `Set::are_equal` for custom comparison logic:
```php
class StrictMap extends PhpRepos\Datatype\Map
{
    protected function are_equal(mixed $key1, mixed $key2): bool
    {
        return $key1 === $key2;
    }
}
```