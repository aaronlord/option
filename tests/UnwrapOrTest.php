<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;

class UnwrapOrTest extends TestCase
{
    public function test_some(): void
    {
        $x = new Some('car');

        $this->assertSame('car', $x->unwrapOr('bike'));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->assertSame('bike', $x->unwrapOr('bike'));
    }
}
