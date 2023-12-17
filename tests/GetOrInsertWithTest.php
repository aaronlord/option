<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class GetOrInsertWithTest extends TestCase
{
    public function two(): int
    {
        return 2;
    }

    public function test_some(): void
    {
        $some = new Some(1);

        $this->assertEquals($some, $some->getOrInsertWith($this->two(...)));
    }

    public function test_none(): void
    {
        $none = new None();

        $this->assertEquals(new Some(2), $none->getOrInsertWith($this->two(...)));
    }
}
