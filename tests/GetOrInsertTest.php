<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class GetOrInsertTest extends TestCase
{
    public function test_some(): void
    {
        $x = new Some(1);

        $this->assertSame($x, $x->getOrInsert(2));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertEquals(new Some(2), $x->getOrInsert(2));
    }
}
