<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class AndThenTest extends TestCase
{
    private function square(int $number): int
    {
        return $number * $number;
    }

    public function test_some(): void
    {
        $x = new Some(2);

        $this->assertEquals(new Some(4), $x->andThen($this->square(...)));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertSame($x, $x->andThen($this->square(...)));
    }
}
