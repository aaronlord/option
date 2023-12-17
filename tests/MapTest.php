<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    private function stringLength(string $value): int
    {
        return strlen($value);
    }

    public function test_some(): void
    {
        $x = new Some('Hello, world!');

        $this->assertEquals(new Some(13), $x->map($this->stringLength(...)));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertInstanceOf(None::class, $x->map($this->stringLength(...)));
    }
}
