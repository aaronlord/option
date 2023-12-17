<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class XorTest extends TestCase
{
    public function test_some_and_none(): void
    {
        $x = new Some(2);
        $y = new None();

        $this->assertSame($x, $x->xor($y));
    }

    public function test_some_and_some(): void
    {
        $x = new Some(2);
        $y = new Some(2);

        $this->assertInstanceOf(None::class, $x->xor($y));
    }

    public function test_none_and_some(): void
    {
        $x = new None();
        $y = new Some(1);

        $this->assertSame($y, $x->xor($y));
    }

    public function test_none_and_none(): void
    {
        $x = new None();
        $y = new None();

        $this->assertInstanceOf(None::class, $x->xor($y));
    }
}
