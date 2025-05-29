<?php

namespace PhpRepos\Datatype\Str;

use AssertionError;
use Stringable;

/**
 * Asserts that two strings are equal (same value after string conversion).
 *
 * @param string|Stringable $actual The actual string to compare.
 * @param string|Stringable $expected The expected string to compare against.
 * @param string|null $message Optional custom error message for the assertion failure.
 * @return true Returns true if the strings are equal.
 * @throws AssertionError If the strings are not equal.
 * @example
 * ```php
 * assert_equal('hello', 'hello'); // Returns true
 * assert_equal('hello', 'world', 'Strings must match'); // Throws AssertionError
 * ```
 */
function assert_equal(string|Stringable $actual, string|Stringable $expected, ?string $message = null): true
{
    if ((string) $actual === (string) $expected) {
        return true;
    }

    if ($message) {
        throw new AssertionError($message);
    }

    throw new AssertionError("Strings are not equal. Expected `$expected` but the actual string is `$actual`.");
}

/**
 * Asserts that two strings are identical (same value and type).
 *
 * @param string|Stringable $actual The actual string to compare.
 * @param string|Stringable $expected The expected string to compare against.
 * @param string|null $message Optional custom error message for the assertion failure.
 * @return true Returns true if the strings are identical.
 * @throws AssertionError If the strings are not identical.
 * @example
 * ```php
 * $str = 'hello';
 * assert_same($str, $str); // Returns true
 * assert_same('hello', 'world', 'Must be same'); // Throws AssertionError
 * ```
 */
function assert_same(string|Stringable $actual, string|Stringable $expected, ?string $message = null): true
{
    if ($actual === $expected) {
        return true;
    }

    if ($message) {
        throw new AssertionError($message);
    }

    $actual = print_r($actual, true);
    $expected = print_r($expected, true);

    throw new AssertionError("Strings are not the same. Expected `$expected` but the actual string is `$actual`.");
}

/**
 * Returns the substring starting from the specified position to the end of the string.
 *
 * Uses UTF-8 encoding for multibyte string support.
 *
 * @param string $subject The input string.
 * @param int $position The starting position (zero-based).
 * @return string The substring from the position to the end.
 * @example
 * ```php
 * $result = after('hello', 2); // Returns 'llo'
 * ```
 */
function after(string $subject, int $position): string
{
    return mb_substr(string: $subject, start: $position, encoding: 'UTF-8');
}

/**
 * Returns the substring after the first occurrence of a needle.
 *
 * If the needle is empty or not found, returns the original string.
 *
 * @param string $subject The input string.
 * @param string $needle The substring to search for.
 * @return string The substring after the first occurrence of the needle, or the original string.
 * @example
 * ```php
 * $result = after_first_occurrence('hello world', ' '); // Returns 'world'
 * $result = after_first_occurrence('hello', 'x'); // Returns 'hello'
 * ```
 */
function after_first_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strpos($subject, $needle)) === false) {
        return $subject;
    }

    return after($subject, $pos + mb_strlen($needle));
}

/**
 * Returns the substring after the last occurrence of a needle.
 *
 * If the needle is empty or not found, returns the original string.
 *
 * @param string $subject The input string.
 * @param string $needle The substring to search for.
 * @return string The substring after the last occurrence of the needle, or the original string.
 * @example
 * ```php
 * $result = after_last_occurrence('hello world hello', ' '); // Returns 'hello'
 * $result = after_last_occurrence('hello', 'x'); // Returns 'hello'
 * ```
 */
function after_last_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strrpos($subject, $needle)) === false) {
        return $subject;
    }

    return after($subject, $pos + mb_strlen($needle));
}

/**
 * Returns the substring from the start of the string up to the specified position.
 *
 * Uses UTF-8 encoding for multibyte string support.
 *
 * @param string $subject The input string.
 * @param int $position The end position (exclusive, zero-based).
 * @return string The substring from the start to the position.
 * @example
 * ```php
 * $result = before('hello', 2); // Returns 'he'
 * ```
 */
function before(string $subject, int $position): string
{
    return mb_substr(string: $subject, start: 0, length: $position, encoding: 'UTF-8');
}

/**
 * Returns the substring before the first occurrence of a needle.
 *
 * If the needle is empty or not found, returns the original string.
 *
 * @param string $subject The input string.
 * @param string $needle The substring to search for.
 * @return string The substring before the first occurrence of the needle, or the original string.
 * @example
 * ```php
 * $result = before_first_occurrence('hello world', ' '); // Returns 'hello'
 * $result = before_first_occurrence('hello', 'x'); // Returns 'hello'
 * ```
 */
function before_first_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strpos($subject, $needle)) === false) {
        return $subject;
    }

    return before($subject, $pos);
}

/**
 * Returns the substring before the last occurrence of a needle.
 *
 * If the needle is empty or not found, returns the original string.
 *
 * @param string $subject The input string.
 * @param string $needle The substring to search for.
 * @return string The substring before the last occurrence of the needle, or the original string.
 * @example
 * ```php
 * $result = before_last_occurrence('hello world hello', ' '); // Returns 'hello world'
 * $result = before_last_occurrence('hello', 'x'); // Returns 'hello'
 * ```
 */
function before_last_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strrpos($subject, $needle)) === false) {
        return $subject;
    }

    return before($subject, $pos);
}

/**
 * Returns the substring between the first occurrence of a start string and the first occurrence of an end string.
 *
 * If either start or end is empty, returns the portion before or after the non-empty delimiter. If both are empty, returns the original string.
 *
 * @param string $subject The input string.
 * @param string $start The starting delimiter.
 * @param string $end The ending delimiter.
 * @return string The substring between the start and end delimiters.
 * @example
 * ```php
 * $result = between('hello [world] end', '[', ']'); // Returns 'world'
 * $result = between('hello world', '', ' '); // Returns 'hello'
 * $result = between('hello world', ' ', ''); // Returns 'world'
 * ```
 */
function between(string $subject, string $start, string $end): string
{
    if ($start === '' && $end === '') {
        return $subject;
    }

    if ($start === '') {
        return before_first_occurrence($subject, $end);
    }

    if ($end === '') {
        return after_first_occurrence($subject, $start);
    }

    $start_position = stripos($subject, $start);
    $first = substr($subject, $start_position);
    $second = substr($first, strlen($start));
    $position_end = stripos($second, $end);

    return substr($second, 0, $position_end);
}

/**
 * Converts a string to camelCase format.
 *
 * Replaces hyphens and underscores with spaces, capitalizes each word, and joins them, making the first letter lowercase.
 *
 * @param string $subject The input string.
 * @return string The camelCase string.
 * @example
 * ```php
 * $result = camel_case('hello_world'); // Returns 'helloWorld'
 * $result = camel_case('hello-world'); // Returns 'helloWorld'
 * ```
 */
function camel_case(string $subject): string
{
    $subject = str_replace(['-', '_'], ' ', $subject);
    $words = preg_split('/[\s]+/', $subject);
    $camelCase = '';
    foreach ($words as $word) {
        $camelCase .= ucfirst($word);
    }
    return lcfirst($camelCase);
}

/**
 * Concatenates multiple strings with a suffix separator, ignoring null values.
 *
 * @param string $suffix The separator to join the strings.
 * @param string|null ...$subjects The strings to concatenate.
 * @return string The concatenated string.
 * @example
 * ```php
 * $result = concat('-', 'a', 'b', null, 'c'); // Returns 'a-b-c'
 * $result = concat(',', 'hello', null); // Returns 'hello'
 * ```
 */
function concat(string $suffix, ?string ...$subjects): string
{
    return implode($suffix, array_filter($subjects));
}

/**
 * Returns the first character of a string.
 *
 * Uses UTF-8 encoding for multibyte string support.
 *
 * @param string $subject The input string.
 * @return string The first character.
 * @example
 * ```php
 * $result = first_character('hello'); // Returns 'h'
 * $result = first_character(''); // Returns ''
 * ```
 */
function first_character(string $subject): string
{
    return mb_substr($subject, 0, 1);
}

/**
 * Returns the first line of a string, trimming whitespace and newlines.
 *
 * @param string $subject The input string.
 * @return string The first line of the string.
 * @example
 * ```php
 * $result = first_line("hello\nworld"); // Returns 'hello'
 * $result = first_line('hello'); // Returns 'hello'
 * ```
 */
function first_line(string $subject): string
{
    $subject = ltrim($subject, PHP_EOL);
    $pos = strpos($subject, PHP_EOL);

    if ($pos !== false) {
        return trim(substr($subject, 0, $pos));
    }

    return trim($subject);
}

/**
 * Returns the last character of a string.
 *
 * Uses UTF-8 encoding for multibyte string support.
 *
 * @param string $subject The input string.
 * @return string The last character.
 * @example
 * ```php
 * $result = last_character('hello'); // Returns 'o'
 * $result = last_character(''); // Returns ''
 * ```
 */
function last_character(string $subject): string
{
    return mb_substr($subject, -1);
}

/**
 * Converts a string to kebab-case format.
 *
 * Inserts hyphens before uppercase letters, replaces spaces and underscores with hyphens, and converts to lowercase.
 *
 * @param string $subject The input string.
 * @return string The kebab-case string.
 * @example
 * ```php
 * $result = kebab_case('helloWorld'); // Returns 'hello-world'
 * $result = kebab_case('hello_world'); // Returns 'hello-world'
 * ```
 */
function kebab_case(string $subject): string
{
    $subject = preg_replace('/([a-z])([A-Z])/', '$1_$2', $subject);

    $subject = preg_replace('/[ _]+/', '-', $subject);

    return strtolower($subject);
}

/**
 * Converts a string to PascalCase format.
 *
 * Converts to camelCase and capitalizes the first letter.
 *
 * @param string $subject The input string.
 * @return string The PascalCase string.
 * @example
 * ```php
 * $result = pascal_case('hello_world'); // Returns 'HelloWorld'
 * $result = pascal_case('hello-world'); // Returns 'HelloWorld'
 * ```
 */
function pascal_case(string $subject): string
{
    return ucfirst(camel_case($subject));
}

/**
 * Prepends a prefix to a string if the string is non-null.
 *
 * @param string|null $subject The input string, or null.
 * @param string $prefix The prefix to prepend.
 * @return string The string with the prefix prepended, or an empty string if the subject is null.
 * @example
 * ```php
 * $result = prepend_when_exists('world', 'hello '); // Returns 'hello world'
 * $result = prepend_when_exists(null, 'hello '); // Returns ''
 * ```
 */
function prepend_when_exists(?string $subject, string $prefix): string
{
    return $subject ? $prefix . $subject : '';
}

/**
 * Removes the first character from a string.
 *
 * Uses UTF-8 encoding for multibyte string support.
 *
 * @param string $subject The input string.
 * @return string The string without the first character.
 * @example
 * ```php
 * $result = remove_first_character('hello'); // Returns 'ello'
 * $result = remove_first_character(''); // Returns ''
 * ```
 */
function remove_first_character(string $subject): string
{
    return mb_substr($subject, 1);
}

/**
 * Removes the last character from a string.
 *
 * Uses UTF-8 encoding for multibyte string support.
 *
 * @param string $subject The input string.
 * @return string The string without the last character.
 * @example
 * ```php
 * $result = remove_last_character('hello'); // Returns 'hell'
 * $result = remove_last_character(''); // Returns ''
 * ```
 */
function remove_last_character(string $subject): string
{
    return mb_substr($subject, 0, mb_strlen($subject) - 1);
}

/**
 * Replaces the first occurrence of a search string with a replacement.
 *
 * If the search string is not found, returns the original string.
 *
 * @param string $subject The input string.
 * @param string $search The string to replace.
 * @param string $replace The replacement string.
 * @return string The string with the first occurrence replaced.
 * @example
 * ```php
 * $result = replace_first_occurrence('hello world', 'l', 'x'); // Returns 'hexlo world'
 * $result = replace_first_occurrence('hello', 'x', 'y'); // Returns 'hello'
 * ```
 */
function replace_first_occurrence(string $subject, string $search, string $replace): string
{
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

/**
 * Converts a string to snake_case format.
 *
 * Inserts underscores before uppercase letters, replaces spaces and hyphens with underscores, and converts to lowercase.
 *
 * @param string $subject The input string.
 * @return string The snake_case string.
 * @example
 * ```php
 * $result = snake_case('helloWorld'); // Returns 'hello_world'
 * $result = snake_case('hello-world'); // Returns 'hello_world'
 * ```
 */
function snake_case(string $subject): string
{
    $subject = preg_replace('/([a-z])([A-Z])/', '$1_$2', $subject);

    $subject = preg_replace('/[ \-]+/', '_', $subject);

    return strtolower($subject);
}

/**
 * Checks if a string starts with a given regular expression pattern.
 *
 * Escapes trailing backslashes in the pattern to prevent regex errors.
 *
 * @param string $subject The input string.
 * @param string $pattern The regular expression pattern to match at the start.
 * @return bool True if the string starts with the pattern, false otherwise.
 * @example
 * ```php
 * $result = starts_with_regex('hello world', 'he'); // Returns true
 * $result = starts_with_regex('hello', 'wo'); // Returns false
 * ```
 */
function starts_with_regex(string $subject, string $pattern): bool
{
    $pattern = str_ends_with($pattern, '\\') ? $pattern . '\\' : $pattern;

    return preg_match("/^$pattern/u", $subject);
}

/**
 * Splits a string into words based on specified separators.
 *
 * @param string $subject The input string.
 * @param string $separators The characters to use as separators (default: space, tab, newline, etc.).
 * @return array An array of non-empty words.
 * @example
 * ```php
 * $result = words('hello world'); // Returns ['hello', 'world']
 * $result = words('hello,world', ','); // Returns ['hello', 'world']
 * ```
 */
function words(string $subject, string $separators = " \t\r\n\f\v"): array
{
    $escaped_separators = preg_quote($separators, '/');
    return preg_split("/[$escaped_separators]+/", $subject, -1, PREG_SPLIT_NO_EMPTY);
}
