<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class OrElseTest extends TestCase
{
    public function test_some_and_none(): void
    {
        $x = new Some(1);
        $y = new None();

        $this->assertSame($x, $x->orElse(fn () => $y));
    }

    public function test_some_and_some(): void
    {
        $x = new Some(1);
        $y = new Some(2);

        $this->assertSame($x, $x->orElse(fn () => $y));
    }

    public function test_none_and_none(): void
    {
        $x = new None();

        $this->assertInstanceOf(None::class, $x->orElse(fn () => $x));
    }

    public function test_none_and_some(): void
    {
        $x = new Some(1);
        $y = new None();

        $this->assertSame($x, $y->orElse(fn () => $x));
    }
}
