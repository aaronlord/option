<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class FlattenTest extends TestCase
{
    public function test_some(): void
    {
        $x = new Some(1);
        $y = new Some($x);

        $this->assertSame($x, $y->flatten());
    }

    public function test_none(): void
    {
        $x = new Some(new None());

        $this->assertInstanceOf(None::class, $x->flatten());
    }

    public function test_some_that_isnt_nested(): void
    {
        $x = new Some(1);

        $this->assertSame($x, $x->flatten());
    }
}
