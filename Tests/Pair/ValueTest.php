<?php

namespace Tests\Pair\ValueTest;

use Saeghe\Datatype\Pair;
use function Saeghe\TestRunner\Assertions\Boolean\assert_true;

test(
    title: 'it should new pair by setting the given value as value for the pair',
    case: function () {
        $pair = new Pair(1, 'foo');
        $new_pair = $pair->value('bar');

        assert_true($pair->value === 'foo');
        assert_true(1 === $new_pair->key);
        assert_true('bar' === $new_pair->value);
    }
);
