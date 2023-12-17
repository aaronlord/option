<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class MapOrTest extends TestCase
{
    private function stringLength(string $value): int
    {
        return strlen($value);
    }

    public function test_some(): void
    {
        $x = new Some('foo');

        $this->assertEquals(3, $x->mapOr(42, $this->stringLength(...)));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertEquals(42, $x->mapOr(42, $this->stringLength(...)));
    }
}
