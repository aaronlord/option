<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class IsSomeAndTest extends TestCase
{
    private function isGreaterThanOne(int $value): bool
    {
        return $value > 1;
    }

    public function test_some_with_predicate_that_returns_true(): void
    {
        $x = new Some(2);

        $this->assertTrue($x->isSomeAnd($this->isGreaterThanOne(...)));
    }

    public function test_some_with_predicate_that_returns_false(): void
    {
        $x = new Some(1);

        $this->assertFalse($x->isSomeAnd($this->isGreaterThanOne(...)));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertFalse($x->isSomeAnd($this->isGreaterThanOne(...)));
    }
}
