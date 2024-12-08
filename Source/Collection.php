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
use function PhpRepos\Datatype\Arr\last_key;
use function PhpRepos\Datatype\Arr\map;
use function PhpRepos\Datatype\Arr\reduce;
use function PhpRepos\Datatype\Arr\skip;
use function PhpRepos\Datatype\Arr\take;

class Collection implements ArrayAccess, IteratorAggregate, Countable
{
    protected array $items;

    public function __construct(?array $init = [])
    {
        $this->items = $init;
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
        return every($this->items(), $check);
    }

    public function except(?Closure $check = null): static
    {
        $check = $check ?? function ($value) {
            return (bool) $value;
        };

        $results = [];

        $this->each(function ($value, $key) use (&$results, $check) {
            if (! $check($value, $key)) {
                $results[$key] = $value;
            }
        });

        return new static($results);
    }

    public function filter(?Closure $closure = null): static
    {
        if ($closure) {
            $results = [];

            $this->each(function ($value, $key) use (&$results, $closure) {
                if ($closure($value, $key)) {
                    $results[$key] = $value;
                }
            });

            return new static($results);
        }

        return new static(array_filter($this->items));
    }

    public function first_key(?Closure $condition = null): string|int|null
    {
        return first_key($this->items(), $condition);
    }

    public function first(?Closure $condition = null): mixed
    {
        return first($this->items(), $condition);
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

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function last_key(?Closure $condition = null): string|int|null
    {
        return last_key($this->items(), $condition);
    }

    public function last(?Closure $condition = null): mixed
    {
        return last($this->items(), $condition);
    }

    public function map(Closure $closure): array
    {
        return map($this->items(), $closure);
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

    public function push(mixed $value): static
    {
        return $this->put($value);
    }

    public function put(mixed $value, int|string|null $key = null): static
    {
        is_null($key) ? $this->items[] = $value : $this->items[$key] = $value;

        return $this;
    }

    public function reduce(Closure $closure, mixed $carry = null): mixed
    {
        return reduce($this->items, $closure, $carry);
    }

    public function skip(int $offset): static
    {
        $collection = new static();
        $collection->items = skip($this->items(), $offset);

        return $collection;
    }

    public function take(Closure $condition): mixed
    {
        return take($this->items, $condition);
    }

    public function values(): array
    {
        return array_values($this->items);
    }
}
