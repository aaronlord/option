<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    public function test_some(): void
    {
        $x = new Some(1);

        $y = $x->insert(2);

        $this->assertEquals(new Some(2), $y);

        $this->assertSame(spl_object_hash($x), spl_object_hash($y));
    }

    public function test_none(): void
    {
        $x = new None();

        $y = $x->insert(2);

        $this->assertEquals(new Some(2), $y);

        $this->assertNotSame(spl_object_hash($x), spl_object_hash($y));
    }
}
