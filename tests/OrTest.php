<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class OrTest extends TestCase
{
    public function test_some_or_none(): void
    {
        $x = new Some(2);
        $y = new None();

        $this->assertSame($x, $x->or($y));
    }

    public function test_some_or_some(): void
    {
        $x = new Some(2);
        $y = new Some('100');

        $this->assertEquals($x, $x->or($y));
    }

    public function test_none_or_some(): void
    {
        $x = new None();
        $y = new Some(100);

        $this->assertEquals($y, $x->or($y));
    }

    public function test_none_or_none(): void
    {
        $x = new None();
        $y = new None();

        $this->assertEquals($y, $x->or($y));
    }
}
