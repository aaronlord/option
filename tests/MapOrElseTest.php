<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class MapOrElseTest extends TestCase
{
    private function stringLength(string $value): int
    {
        return strlen($value);
    }

    private function zero(): int
    {
        return 0;
    }

    public function test_some(): void
    {
        $x = new Some('Hello, world!');

        $this->assertEquals(13, $x->mapOrElse($this->zero(...), $this->stringLength(...)));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertEquals(0, $x->mapOrElse($this->zero(...), $this->stringLength(...)));
    }
}
