<?php

namespace PhpRepos\Datatype;

use Stringable;
use function PhpRepos\Datatype\Str\camel_case;
use function PhpRepos\Datatype\Str\concat;
use function PhpRepos\Datatype\Str\kebab_case;
use function PhpRepos\Datatype\Str\pascal_case;
use function PhpRepos\Datatype\Str\remove_first_character;
use function PhpRepos\Datatype\Str\remove_last_character;
use function PhpRepos\Datatype\Str\snake_case;

/**
 * A fluent string manipulation class implementing Stringable.
 *
 * Provides methods to transform and concatenate strings with a chainable interface.
 *
 * @example
 * ```php
 * $text = new Text('hello');
 * $text->append(' world')->camel_case(); // Results in 'helloWorld'
 * ```
 */
class Text implements Stringable
{
    /**
     * The underlying string value.
     *
     * @var string
     */
    protected string $string;

    /**
     * Constructs a new Text instance with an optional initial string.
     *
     * @param string|null $init The initial string value. Defaults to an empty string if null.
     * @example
     * ```php
     * $text = new Text('hello'); // Initializes with 'hello'
     * $text = new Text(); // Initializes with ''
     * ```
     */
    public function __construct(?string $init = null)
    {
        $this->string = $init ?: '';
    }

    /**
     * Creates a new Text instance from an optional string.
     *
     * @param string|null $init The initial string value.
     * @return static A new Text instance.
     * @example
     * ```php
     * $text = Text::from('hello'); // Creates a Text instance with 'hello'
     * $text = Text::from(null); // Creates a Text instance with ''
     * ```
     */
    public static function from(?string $init): static
    {
        return new static($init);
    }

    /**
     * Returns the underlying string value.
     *
     * @return string The current string.
     * @example
     * ```php
     * $text = new Text('hello');
     * $string = $text->string(); // Returns 'hello'
     * ```
     */
    public function string(): string
    {
        return $this->string;
    }

    /**
     * Sets the underlying string value.
     *
     * @param string $string The new string value.
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello');
     * $text->set('world'); // Text now contains 'world'
     * ```
     */
    public function set(string $string): static
    {
        $this->string = $string;

        return $this;
    }

    /**
     * Appends one or more strings to the current string without a separator.
     *
     * @param string ...$subjects The strings to append.
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello');
     * $text->append(' ', 'world'); // Text now contains 'hello world'
     * ```
     */
    public function append(string ...$subjects): static
    {
        $this->string = concat('', $this, ...$subjects);

        return $this;
    }

    /**
     * Concatenates the current string with other strings using a suffix separator.
     *
     * @param string $suffix The separator to join the strings.
     * @param string ...$subjects The strings to concatenate.
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello');
     * $text->concat('-', 'world', 'test'); // Text now contains 'hello-world-test'
     * ```
     */
    public function concat(string $suffix, ...$subjects): static
    {
        $this->string = concat($suffix, $this, ...$subjects);

        return $this;
    }

    /**
     * Applies a callback function to transform the current string.
     *
     * @param callable $callback The callback to apply. Receives the current string as a parameter.
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello');
     * $text->map(fn($str) => strtoupper($str)); // Text now contains 'HELLO'
     * ```
     */
    public function map(callable $callback): static
    {
        $this->string = $callback($this);

        return $this;
    }

    /**
     * Converts the current string to camelCase format.
     *
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello_world');
     * $text->camel_case(); // Text now contains 'helloWorld'
     * ```
     */
    public function camel_case(): static
    {
        $this->string = camel_case($this);

        return $this;
    }

    /**
     * Converts the current string to kebab-case format.
     *
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('helloWorld');
     * $text->kebab_case(); // Text now contains 'hello-world'
     * ```
     */
    public function kebab_case(): static
    {
        $this->string = kebab_case($this);

        return $this;
    }

    /**
     * Converts the current string to PascalCase format.
     *
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello_world');
     * $text->pascal_case(); // Text now contains 'HelloWorld'
     * ```
     */
    public function pascal_case(): static
    {
        $this->string = pascal_case($this);

        return $this;
    }

    /**
     * Converts the current string to snake_case format.
     *
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('helloWorld');
     * $text->snake_case(); // Text now contains 'hello_world'
     * ```
     */
    public function snake_case(): static
    {
        $this->string = snake_case($this);

        return $this;
    }

    /**
     * Removes the first character from the current string.
     *
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello');
     * $text->remove_first_character(); // Text now contains 'ello'
     * ```
     */
    public function remove_first_character(): static
    {
        $this->string = remove_first_character($this);

        return $this;
    }

    /**
     * Removes the last character from the current string.
     *
     * @return static Returns the Text instance for method chaining.
     * @example
     * ```php
     * $text = new Text('hello');
     * $text->remove_last_character(); // Text now contains 'hell'
     * ```
     */
    public function remove_last_character(): static
    {
        $this->string = remove_last_character($this);

        return $this;
    }

    /**
     * Returns the string representation of the Text instance.
     *
     * Implements the Stringable interface.
     *
     * @return string The current string.
     * @example
     * ```php
     * $text = new Text('hello');
     * echo $text; // Outputs 'hello'
     * ```
     */
    public function __toString(): string
    {
        return $this->string();
    }
}
