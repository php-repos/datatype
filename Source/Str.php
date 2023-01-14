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

function first_character(string $subject): string
{
    return mb_substr($subject, 0, 1);
}

function last_character(string $subject): string
{
    return mb_substr($subject, -1);
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

function starts_with_regex(string $subject, string $pattern): bool
{
    $pattern = str_ends_with($pattern, '\\') ? $pattern . '\\' : $pattern;

    return preg_match("/^$pattern/u", $subject);
}
