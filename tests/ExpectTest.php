<?php

declare(strict_types=1);

namespace Tests;

use LogicException;
use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ExpectTest extends TestCase
{
    public function test_some(): void
    {
        $x = new Some('value');

        $this->assertEquals('value', $x->expect('fruits are healthy'));
    }

    public function test_some_with_exception(): void
    {
        $x = new Some('value');

        $this->assertEquals('value', $x->expect(new LogicException('fruits are healthy')));
    }

    public function test_none(): void
    {
        $x = new None();

        $this->expectExceptionMessage('fruits are healthy');
        $this->expectException(RuntimeException::class);

        $x->expect('fruits are healthy');
    }

    public function test_none_with_exception(): void
    {
        $x = new None();

        $this->expectExceptionMessage('fruits are healthy');
        $this->expectException(LogicException::class);

        $x->expect(new LogicException('fruits are healthy'));
    }
}
