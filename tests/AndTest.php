<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class AndTest extends TestCase
{
    public function test_some_and_none(): void
    {
        $x = new Some(2);
        $y = new None();

        $this->assertSame($y, $x->and($y));
    }

    public function test_none_and_some(): void
    {
        $x = new None();
        $y = new Some('foo');

        $this->assertInstanceOf(None::class, $x->and($y));
    }

    public function test_some_and_some(): void
    {
        $x = new Some(2);
        $y = new Some('foo');

        $this->assertSame($y, $x->and($y));
    }

    public function test_none_and_none(): void
    {
        $x = new None();
        $y = new None();

        $this->assertInstanceOf(None::class, $x->and($y));
    }
}
