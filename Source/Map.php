<?php

namespace PhpRepos\Datatype;

use ArrayAccess;
use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;
use Traversable;
use function PhpRepos\Datatype\Arr\every;
use function PhpRepos\Datatype\Arr\first;
use function PhpRepos\Datatype\Arr\first_key;
use function PhpRepos\Datatype\Arr\forget;
use function PhpRepos\Datatype\Arr\has;
use function PhpRepos\Datatype\Arr\last;
use function PhpRepos\Datatype\Arr\map;
use function PhpRepos\Datatype\Arr\reduce;
use function PhpRepos\Datatype\Arr\skip;
use function PhpRepos\Datatype\Arr\take;

class Map implements ArrayAccess, IteratorAggregate, Countable
{
    protected array $items;

    public function __construct(array $init = [])
    {
        $this->items = [];
        foreach ($init as $index => $item) {
            $this->put($item, $index);
        }
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function each(Closure $closure): static
    {
        foreach ($this->items as $key => $value) {
            $closure($value, $key);
        }

        return $this;
    }

    public function every(?Closure $check = null): bool
    {
        $check = $check ? fn (Pair $pair) => $check($pair) : fn (Pair $pair) => $pair->value;

        return every($this->items, $check);
    }

    public function except(?Closure $check = null): static
    {
        $check = $check ?? function (Pair $pair) {
            return (bool) $pair->value;
        };

        return $this->reduce(function (Map $results, Pair $pair, mixed $index) use ($check) {
            return ! $check($pair, $index) ? $results->put($pair, $index) : $results;
        }, new static([]));
    }

    public function filter(?Closure $check = null): static
    {
        $check = $check ?? function (Pair $pair) {
            return (bool) $pair->value;
        };

        return $this->reduce(function (Map $results, Pair $pair, mixed $index) use ($check) {
            return $check($pair, $index) ? $results->put($pair, $index) : $results;
        }, new static([]));
    }

    public function first_key(?Closure $closure = null): null|int|string
    {
        $key = first_key($this->items, $closure);

        return $this->items[$key]?->key;
    }

    public function first(?Closure $condition = null): ?Pair
    {
        return first($this->items, $condition);
    }

    public function forget(Closure $condition): static
    {
        $this->items = forget($this->items, $condition);

        return $this;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function has(Closure $closure): bool
    {
        return has($this->items(), $closure);
    }

    public function items(): array
    {
        return $this->items;
    }

    public function last(?Closure $condition = null): ?Pair
    {
        return last($this->items, $condition);
    }

    public function keys(): array
    {
        $keys = [];
        foreach ($this->items as $item) {
            $keys[] = $item->key;
        }
        return $keys;
    }

    public function map(Closure $callable): array
    {
        return map($this->items, $callable);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->put($value, $offset);
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    public function push(Pair $item): static
    {
        return $this->put($item);
    }

    public function put(Pair $item, int|string|null $index = null): static
    {
        $index = is_null($index) ? array_search($item->key, array_values($this->keys())) : $index;

        if ($index === false) {
            $this->items[] = $item;
        } else {
            $this->items[$index] = $item;
        }

        return $this;
    }

    public function reduce(Closure $closure, mixed $carry = null): mixed
    {
        return reduce($this->items, $closure, $carry);
    }

    public function skip(int $offset): static
    {
        $map = new static();
        $map->items = skip($this->items(), $offset);

        return $map;
    }

    public function take(Closure $condition): ?Pair
    {
        return take($this->items, $condition);
    }

    public function values(): array
    {
        $values = [];
        foreach ($this->items as $item) {
            $values[] = $item->value;
        }
        return $values;
    }
}
