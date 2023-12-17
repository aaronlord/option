<?php

declare(strict_types=1);

namespace Lord\Option;

use Throwable;

/**
 * @template T
 *
 * @implements OptionInterface<T>
 */
final class Some implements OptionInterface
{
    /**
     * @param T $value
     */
    public function __construct(
        protected mixed $value
    ) {
    }

    /**
     * Returns None if the option is None, otherwise returns optb.
     *
     * param OptionInterface<mixed> $optb
     *
     * return OptionInterface<mixed>
     */
    public function and(OptionInterface $optb): OptionInterface
    {
        return $optb;
    }

    /**
     * Returns None if the option is None, otherwise calls f with the wrapped value and returns the result.
     *
     * @param callable(T): T $f
     *
     * @return OptionInterface<T>
     */
    public function andThen(callable $f): OptionInterface
    {
        return new static($f($this->value));
    }

    /**
     * @return OptionInterface<T>
     */
    public function cloned(): OptionInterface
    {
        return clone $this;
    }

    /**
     * @return OptionInterface<T>
     */
    public function copied(): OptionInterface
    {
        return new static(clone $this->value);
    }

    /**
     * Returns the contained Some value.
     *
     * @param string|Throwable $msg
     *
     * @return T
     */
    public function expect(string|Throwable $msg): mixed
    {
        return $this->value;
    }

    /**
     * Returns None if the option is None, otherwise calls predicate with the wrapped value and returns:
     * - Some(t) if predicate returns true (where t is the wrapped value), and
     * - None if predicate returns false.
     *
     * @param callable(T): bool $predicate
     *
     * @return OptionInterface<T>
     */
    public function filter(callable $predicate): OptionInterface
    {
        if ($predicate($this->value) === true) {
            return $this;
        }

        return new None();
    }

    /**
     * Converts from OptionInterface<OptionInterface<T>> to OptionInterface<T>.
     *
     * @return OptionInterface<T>
     */
    public function flatten(): OptionInterface
    {
        if ($this->value instanceof OptionInterface) {
            return $this->value;
        }

        return $this;
    }

    /**
     * Inserts value into the option if it is None, then returns Some with the contained value.
     *
     * See also OptionInterface::insert, which updates the value even if the option already contains Some.
     *
     * @param T $value
     *
     * @return Some<T>
    */
    public function getOrInsert(mixed $value): OptionInterface
    {
        return $this;
    }

    /**
     * Inserts a value computed from f into the option if it is None, then returns Some with the contained value.
     *
     * @param callable(): T $f
     *
     * @return Some<T>
     */
    public function getOrInsertWith(callable $f): OptionInterface
    {
        return $this;
    }

    /**
     * Inserts value into the option, then returns Some with the contained value.
     *
     * If the option already contains a value, the old value is dropped.
     *
     * See also OptionInterface::getOrInsert, which doesn’t update the value if the option already contains Some.
     *
     * @param T $value
     *
     * @return Some<T>
     */
    public function insert(mixed $value): OptionInterface
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Returns true if the option is a None value.
     */
    public function isNone(): bool
    {
        return false;
    }

    /**
     * Returns true if the option is a Some value.
     */
    public function isSome(): bool
    {
        return true;
    }

    /**
     * Returns true if the option is a Some and the value inside of it matches a predicate.
     *
     * @param callable(T): bool $predicate
     *
     * @return bool
     */
    public function isSomeAnd(callable $predicate): bool
    {
        return $predicate($this->value);
    }

    /**
     * Maps an OptionInterface<T> to OptionInterface<mixed> by applying a function to a contained value (if Some) or returns None (if None).
     *
     * @param callable(T): mixed $f
     *
     * @return OptionInterface<mixed>
     */
    public function map(callable $f): OptionInterface
    {
        return new static($f($this->value));
    }

    /**
     * Returns the provided default result (if None), or applies a function to the contained value.
     *
     * @param mixed $default
     * @param callable(T): mixed $f
     */
    public function mapOr(mixed $default, callable $f): mixed
    {
        return $f($this->value);
    }

    /**
     * Computes a default function result (if None), or applies a different function to the contained value.
     *
     * @param callable(): mixed $d
     * @param callable(T): mixed $f
     */
    public function mapOrElse(callable $d, callable $f): mixed
    {
        return $f($this->value);
    }

    /**
     * Returns the option if it contains a value, otherwise returns optb.
     *
     * @param OptionInterface<mixed> $optb
     *
     * @return OptionInterface<T>
     */
    public function or(OptionInterface $optb): OptionInterface
    {
        return $this;
    }

    /**
     * Returns the option if it contains a value, otherwise calls f and returns the result.
     *
     * @param callable(): OptionInterface<T> $f
     *
     * @return OptionInterface<T>
     */
    public function orElse(callable $f): OptionInterface
    {
        return $this;
    }

    /**
     * Returns the contained Some value.
     *
     * Because this function may throw a throw a RuntimeException, its use is generally discouraged. Instead, prefer to use pattern matching and handle the None case explicitly, or call unwrapOr, unwrapOrElse, or unwrapOrDefault.
     *
     * @return T
     */
    public function unwrap(): mixed
    {
        return $this->value;
    }

    /**
     * Returns the contained Some value or a provided default.
     *
     * @return T
     */
    public function unwrapOr(mixed $or): mixed
    {
        return $this->unwrap();
    }

    /**
     * Returns Some if exactly one of self, optb is Some, otherwise returns None.
     *
     * @param OptionInterface<T> $optb
     *
     * @return OptionInterface<T>
     */
    public function xor(OptionInterface $optb): OptionInterface
    {
        if ($optb->isSome() === true) {
            return new None();
        }

        return $this;
    }
}
