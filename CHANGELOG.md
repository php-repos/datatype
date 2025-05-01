# Changelog

All notable changes to the `datatype` package will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/), and this project adheres to [Semantic Versioning](https://semver.org/).

## [4.0.0] - 2025-05-26

### Added
- Initial release of the `datatype` package for `phpkg`, providing a fluent, extensible API for managing various data structures.
- Component: `Arr`
  - Helper functions for array and iterable operations.
  - Key functions: `to_array`, `map`, `first`, `forget`, `contains`, `assert_equal`, `assert_same`.
  - Supports arrays, iterables, and objects with a `to_array` method.
- Component: `Collection`
  - Fluent wrapper for arrays with chainable methods.
  - Implements `ArrayAccess`, `IteratorAggregate`, and `Countable`.
  - Key methods: `push`, `put`, `set`, `map`, `forget`, `take_first`.
- Component: `Map`
  - Key-value store ensuring unique keys, stored as pairs (`['key' => $key, 'value' => $value]`).
  - Implements `ArrayAccess`, `IteratorAggregate`, and `Countable`.
  - Key methods: `put`, `set`, `swap`, `map`, `forget`, `offsetGet`.
  - Extensible via `are_equal` method for custom comparison logic.
- Component: `Set`
  - Collection of unique values using loose equality.
  - Implements `ArrayAccess`, `IteratorAggregate`, and `Countable`.
  - Key methods: `add`, `remove`, `forget`, `map`, `clear`, `range`, `alphabet`.
  - Extensible via `are_equal` method.
- Component: `Str`
  - String manipulation functions with UTF-8 support.
  - Handles `string` and `Stringable` inputs.
  - Key functions: `camel_case`, `kebab_case`, `snake_case`, `between`, `after_first_occurrence`, `starts_with_regex`, `words`.
- Component: `Text`
  - Fluent wrapper for strings, implementing `Stringable`.
  - Key methods: `append`, `concat`, `map`, `camel_case`, `snake_case`, `remove_first_character`.
- Support for extensibility in `Map` and `Set` through customizable comparison logic.
- Comprehensive documentation:
  - High-level overview in [README.md](README.md).
  - Detailed function and method reference in [API.md](API.md).
  - Contribution guidelines in [CONTRIBUTING.md](.github/CONTRIBUTING.md).
- UTF-8 encoding support for string operations in `Str` and `Text`.
- Type flexibility with `mixed` types, `Stringable` objects, and strict type declarations.
- Foundation for future expansion with additional data types.

[4.0.0]: https://github.com/php-repos/datatype/releases/tag/v4.0.0