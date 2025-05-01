# Datatype Package

The `datatype` package is a versatile PHP library providing a fluent, expressive API for managing various data structures. Built for the `phpkg` package manager, it offers robust utilities with UTF-8 support, type flexibility, and extensibility, suitable for a wide range of applications.

## Features
- **Utility Functions**: Comprehensive tools for data operations, supporting diverse input types.
- **Fluent Interfaces**: Chainable methods for intuitive data manipulation.
- **Type Flexibility**: Handles `mixed` types, `Stringable` objects, and strict type declarations.
- **Extensibility**: Customizable logic for comparison and processing.
- **UTF-8 Support**: Ensures proper handling of multibyte strings.

## Installation
Add the package using `phpkg`:

```bash
phpkg add https://github.com/php-repos/datatype.git
```

Ensure your project is configured to use `phpkg` and autoloads PSR-4 namespaces.

## Components
The package includes the following components under the `PhpRepos\Datatype` namespace:

### Arr
Helper functions for array and iterable operations, supporting arrays, iterables, and objects with a `to_array` method.

- **Key Functions**: `to_array`, `map`, `first`, `forget`, `contains`.
- **Usage Example**:
```php
use PhpRepos\Datatype\Arr;

$array = Arr\to_array(new ArrayIterator([1, 2, 3])); // [1, 2, 3]
$result = Arr\map([1, 2, 3], fn($v) => $v * 2); // [2, 4, 6]
```

### Collection
A fluent wrapper for arrays, implementing `ArrayAccess`, `IteratorAggregate`, and `Countable` for array-like behavior.

- **Key Methods**: `push`, `put`, `set`, `map`, `forget`, `take_first`.
- **Usage Example**:
```php
use PhpRepos\Datatype\Collection;

$collection = Collection::make([1, 2, 3])
  ->push(4)
  ->map(fn($v) => $v * 2)
  ->forget(fn($v) => $v > 5);
// Results in [2, 4]
```

### Map
A key-value store ensuring unique keys, storing pairs as `['key' => $key, 'value' => $value]`, with fluent operations and `ArrayAccess`.

- **Key Methods**: `put`, `set`, `swap`, `map`, `forget`, `offsetGet`.
- **Usage Example**:
```php
use PhpRepos\Datatype\Map;

$map = Map::from([['key' => 'a', 'value' => 1], ['key' => 'b', 'value' => 2]])
  ->put('c', 3)
  ->set('a', 10)
  ->map(fn($v) => $v * 2);
// Results in [['key' => 'a', 'value' => 20], ['key' => 'b', 'value' => 4], ['key' => 'c', 'value' => 6]]
```

### Set
A collection of unique values, enforcing uniqueness via loose equality, with fluent operations and `ArrayAccess`.

- **Key Methods**: `add`, `remove`, `forget`, `map`, `clear`, `range`, `alphabet`.
- **Usage Example**:
```php
use PhpRepos\Datatype\Set;

$set = Set::range(1, 3)
  ->add(3, 4)
  ->remove(2);
// Results in [1, 3, 4]
```

### Str
Functions for string manipulation with UTF-8 support, handling `string` and `Stringable` inputs.

- **Key Functions**: `camel_case`, `kebab_case`, `snake_case`, `between`, `after_first_occurrence`, `starts_with_regex`.
- **Usage Example**:
```php
use PhpRepos\Datatype\Str;

$result = Str\camel_case('hello_world'); // 'helloWorld'
$substring = Str\between('hello [world] end', '[', ']'); // 'world'
```

### Text
A fluent wrapper for strings, implementing `Stringable`, with chainable methods for transformations.

- **Key Methods**: `append`, `concat`, `map`, `camel_case`, `snake_case`, `remove_first_character`.
- **Usage Example**:
```php
use PhpRepos\Datatype\Text;

$text = Text::from('hello')
  ->append(' world')
  ->snake_case()
  ->map(fn($str) => strtoupper($str));
// Results in 'HELLO_WORLD'
```

## Combining Components
The components work together to enable powerful data transformations.

**Example**:
```php
use PhpRepos\Datatype\Collection;
use PhpRepos\Datatype\Text;

$collection = Collection::make(['hello_world', 'foo_bar'])
    ->map(fn($str) => Text::from($str)->camel_case()->string())
    ->to_array();
// ['helloWorld', 'fooBar']
```

## Extensibility
Customize comparison logic in `Map` and `Set` by overriding the `are_equal` method.

**Example**:
```php
use PhpRepos\Datatype\Map;

class StrictMap extends Map
{
    protected function are_equal(mixed $key1, mixed $key2): bool
    {
        return $key1 === $key2; // Strict equality
    }
}

$map = (new StrictMap())->put(1, 'one')->put('1', 'string one');
$array = $map->to_array(); // [['key' => 1, 'value' => 'one'], ['key' => '1', 'value' => 'string one']]
```

## API Reference
For detailed documentation of all functions, methods, and classes, see [API.md](API.md).

## Requirements
- PHP 8.2 or higher.
- `phpkg` package manager.
- Multibyte string extension (`mbstring`) for `Str` and `Text` UTF-8 support.

## Contributing
Contributions are welcome! Submit issues or pull requests to the [GitHub repository](https://github.com/php-repos/datatype).

## License
Licensed under the MIT License, as specific in the [LICENSE](LICENSE).
