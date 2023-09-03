<?php

namespace PhpRepos\Datatype\Str;

function after_first_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strpos($subject, $needle)) === false) {
        return $subject;
    }

    return mb_substr(string: $subject, start: $pos + mb_strlen($needle),  encoding: 'UTF-8');
}

function after_last_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strrpos($subject, $needle)) === false) {
        return $subject;
    }

    return mb_substr(string: $subject, start: $pos + mb_strlen($needle),  encoding: 'UTF-8');
}

function before_first_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strpos($subject, $needle)) === false) {
        return $subject;
    }

    return mb_substr(string: $subject, start: 0, length: $pos,  encoding: 'UTF-8');
}

function before_last_occurrence(string $subject, string $needle): string
{
    if ($needle === '' || ($pos = mb_strrpos($subject, $needle)) === false) {
        return $subject;
    }

    return mb_substr(string: $subject, start: 0, length: $pos,  encoding: 'UTF-8');
}

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

function concat(string $suffix, ?string ...$subjects): string
{
    return implode($suffix, array_filter($subjects));
}

function first_character(string $subject): string
{
    return mb_substr($subject, 0, 1);
}

function first_line(string $subject): string
{
    $subject = ltrim($subject, PHP_EOL);
    $pos = strpos($subject, PHP_EOL);

    if ($pos !== false) {
        return trim(substr($subject, 0, $pos));
    }

    return trim($subject);
}

function last_character(string $subject): string
{
    return mb_substr($subject, -1);
}

function kebab_case(string $subject): string
{
    // Use a regular expression to insert underscores before uppercase letters
    $subject = preg_replace('/([a-z])([A-Z])/', '$1_$2', $subject);

    // Replace spaces and underscores with hyphen
    $subject = preg_replace('/[ _]+/', '-', $subject);

    // Convert to lowercase
    return strtolower($subject);
}

function pascal_case(string $subject): string
{
    return ucfirst(camel_case($subject));
}

function prepend_when_exists(?string $subject, string $prefix): string
{
    return $subject ? $prefix . $subject : '';
}

function remove_first_character(string $subject): string
{
    return mb_substr($subject ,1);
}

function remove_last_character(string $subject): string
{
    return mb_substr($subject, 0, mb_strlen($subject) - 1);
}

function replace_first_occurrence(string $subject, string $search, string $replace): string
{
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

function snake_case(string $subject): string
{
    // Use a regular expression to insert underscores before uppercase letters
    $subject = preg_replace('/([a-z])([A-Z])/', '$1_$2', $subject);

    // Replace spaces and hyphens with underscores
    $subject = preg_replace('/[ \-]+/', '_', $subject);

    // Convert to lowercase
    return strtolower($subject);
}

function starts_with_regex(string $subject, string $pattern): bool
{
    $pattern = str_ends_with($pattern, '\\') ? $pattern . '\\' : $pattern;

    return preg_match("/^$pattern/u", $subject);
}

function words(string $subject, string $separators = " \t\r\n\f\v"): array
{
    $escaped_separators = preg_quote($separators, '/');
    return preg_split("/[$escaped_separators]+/", $subject, -1, PREG_SPLIT_NO_EMPTY);
}
