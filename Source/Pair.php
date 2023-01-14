<?php

namespace PhpRepos\Datatype;

class Pair
{
    public function __construct(public mixed $key, public mixed $value) {}

    public function get(): array
    {
        return ['key' => $this->key, 'value' => $this->value];
    }

    public function value(mixed $value): static
    {
        return new static($this->key, $value);
    }
}
