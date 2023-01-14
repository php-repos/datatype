<?php

namespace PhpRepos\Datatype;

class Tree
{
    protected Collection $vertices;
    protected Collection $edges;

    public function __construct(public mixed $root)
    {
        $this->vertices = new Collection([$this->root]);
        $this->edges = new Collection();
    }

    public function edge($vertex, $leaf): static
    {
        $this->vertices->push($leaf);
        $this->edges->push(new Pair($vertex, $leaf));

        return $this;
    }

    public function edges(): Collection
    {
        return $this->edges;
    }

    public function vertices(): Collection
    {
        return $this->vertices;
    }
}
