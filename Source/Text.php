<?php

namespace PhpRepos\Datatype;

use Stringable;

class Text implements Stringable
{
    private string $string;

    public function __construct(?string $init = null)
    {
        $this->string = $init ?: '';
    }

    public function set(string $string): static
    {
        $this->string = $string;

        return $this;
    }

    public function string(): string
    {
        return $this->string;
    }

    public function __toString(): string
    {
        return $this->string();
    }
}
