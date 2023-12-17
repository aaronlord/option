<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
    private function isEven(int $n): bool
    {
        return $n % 2 === 0;
    }

    public function test_some_with_predicate_that_returns_true(): void
    {
        $x = new Some(4);

        $this->assertSame($x, $x->filter($this->isEven(...)));
    }

    public function test_some_with_predicate_that_returns_false(): void
    {
        $x = new Some(3);

        $this->assertInstanceOf(None::class, $x->filter($this->isEven(...)));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertInstanceOf(None::class, $x->filter($this->isEven(...)));
    }
}
