<?php

namespace Tests\Tree\TreeTest;

use PhpRepos\Datatype\Collection;
use PhpRepos\Datatype\Tree;
use function PhpRepos\TestRunner\Assertions\Boolean\assert_true;
use function PhpRepos\TestRunner\Runner\test;

test(
    title: 'it should make a tree',
    case: function () {
        $tree = new Tree('/');

        assert_true($tree->root === '/');
        assert_true($tree->vertices() instanceof Collection);
        assert_true($tree->edges() instanceof Collection);
        assert_true(['/'] === $tree->vertices()->items());
        assert_true([] === $tree->edges()->items());
    }
);
