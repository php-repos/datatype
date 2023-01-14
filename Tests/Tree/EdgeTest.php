<?php

namespace Tests\Tree\EdgeTest;

use PhpRepos\Datatype\Pair;
use PhpRepos\Datatype\Tree;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should add the given edge to the tree',
    case: function () {
        $tree = new Tree('/');
        $tree->edge('/', 'home');

        assert_true(['/', 'home'] === $tree->vertices()->items());
        assert_true([new Pair('/', 'home')] == $tree->edges()->items());
    }
);
