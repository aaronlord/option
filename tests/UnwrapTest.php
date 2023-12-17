<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class UnwrapTest extends TestCase
{
    public function test_some(): void
    {
        $x = new Some('air');

        $this->assertSame('air', $x->unwrap());
    }

    public function test_none(): void
    {
        $x = new None();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Attempt to call `unwrap()` on `None` value');

        $x->unwrap();
    }
}
