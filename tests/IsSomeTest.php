<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class IsSomeTest extends TestCase
{
    public function test_some_is_some(): void
    {
        $x = new Some(1);

        $this->assertTrue($x->isSome());
    }

    public function test_some_is_not_none(): void
    {
        $x = new Some(1);

        $this->assertFalse($x->isNone());
    }

    public function test_none_is_none(): void
    {
        $x = new None();

        $this->assertTrue($x->isNone());
    }

    public function test_none_is_not_some(): void
    {
        $x = new None();

        $this->assertFalse($x->isSome());
    }
}
