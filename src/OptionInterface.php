<?php

declare(strict_types=1);

namespace Lord\Option;

use Throwable;

/**
 * @template T
 */
interface OptionInterface
{
    /**
     * Returns None if the option is None, otherwise returns optb.
     *
     * @param OptionInterface<mixed> $optb
     *
     * @return OptionInterface<mixed>
     */
    public function and(OptionInterface $optb): OptionInterface;

    /**
     * Returns None if the option is None, otherwise calls f with the wrapped value and returns the result.
     *
     * @param callable(T): T $f
     *
     * @return OptionInterface<T>
     */
    public function andThen(callable $f): OptionInterface;

    /**
     * @return OptionInterface<T>
     */
    public function cloned(): OptionInterface;

    /**
     * @return OptionInterface<T>
     */
    public function copied(): OptionInterface;

    /**
     * Returns the contained Some value.
     *
     * @param string|Throwable $msg
     *
     * @return T
     */
    public function expect(string|Throwable $msg): mixed;

    /**
     * Returns None if the option is None, otherwise calls predicate with the wrapped value and returns:
     * - Some(t) if predicate returns true (where t is the wrapped value), and
     * - None if predicate returns false.
     *
     * @param callable(T): bool $predicate
     *
     * @return OptionInterface<T>
     */
    public function filter(callable $predicate): OptionInterface;

    /**
     * Converts from OptionInterface<OptionInterface<T>> to OptionInterface<T>.
     *
     * @return OptionInterface<T>
     */
    public function flatten(): OptionInterface;

    /**
     * Inserts value into the option if it is None, then returns Some with the contained value.
     *
     * See also insert, which updates the value even if the option already contains Some.
     *
     * @param T $value
     *
     * @return Some<T>
     */
    public function getOrInsert(mixed $value): OptionInterface;

    /**
     * Inserts a value computed from f into the option if it is None, then returns Some with the contained value.
     *
     * @param callable(): T $f
     *
     * @return Some<T>
     */
    public function getOrInsertWith(callable $f): OptionInterface;

    /**
     * Inserts value into the option, then returns Some with the contained value.
     *
     * If the option already contains a value, the old value is dropped.
     *
     * See also getOrInsert, which doesn’t update the value if the option already contains Some.
     *
     * @param T $value
     *
     * @return Some<T>
     */
    public function insert(mixed $value): OptionInterface;

    /**
     * Returns true if the option is a None value.
     */
    public function isNone(): bool;

    /**
     * Returns true if the option is a Some value.
     */
    public function isSome(): bool;

    /**
     * Returns true if the option is a Some and the value inside of it matches a predicate.
     *
     * @param callable(T): bool $predicate
     *
     * @return bool
     */
    public function isSomeAnd(callable $predicate): bool;

    /**
     * Maps an OptionInterface<T> to OptionInterface<mixed> by applying a function to a contained value (if Some) or returns None (if None).
     *
     * @param callable(T): mixed $f
     *
     * @return OptionInterface<mixed>
     */
    public function map(callable $f): OptionInterface;

    /**
     * Returns the provided default result (if None), or applies a function to the contained value.
     *
     * @param mixed $default
     * @param callable(T): mixed $f
     */
    public function mapOr(mixed $default, callable $f): mixed;

    /**
     * Computes a default function result (if None), or applies a different function to the contained value.
     *
     * @param callable(): mixed $d
     * @param callable(T): mixed $f
     */
    public function mapOrElse(callable $d, callable $f): mixed;

    /**
     * Returns the option if it contains a value, otherwise returns optb.
     *
     * @param OptionInterface<mixed> $optb
     *
     * @return OptionInterface<T>
     */
    public function or(OptionInterface $optb): OptionInterface;

    /**
     * Returns the option if it contains a value, otherwise calls f and returns the result.
     *
     * @param callable(): OptionInterface<T> $f
     *
     * @return OptionInterface<T>
     */
    public function orElse(callable $f): OptionInterface;

    /**
     * Returns the contained Some value.
     *
     * Because this function may throw a throw a RuntimeException, its use is generally discouraged. Instead, prefer to use pattern matching and handle the None case explicitly, or call unwrapOr, unwrapOrElse, or unwrapOrDefault.
     */
    public function unwrap(): mixed;

    /**
     * Returns the contained Some value or a provided default.
     */
    public function unwrapOr(mixed $or): mixed;

    /**
     * Returns Some if exactly one of self, optb is Some, otherwise returns None.
     *
     * @param OptionInterface<T> $optb
     *
     * @return OptionInterface<T>
     */
    public function xor(OptionInterface $optb): OptionInterface;
}
