<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;
use stdClass;

class CopiedTest extends TestCase
{
    public function test_some(): void
    {
        $obj = new stdClass();
        $obj->foo = 'bar';

        $some = new Some($obj);

        $some2 = $some->copied();
        $obj2 = $some2->unwrap();

        $obj->foo = 'baz';

        $this->assertNotEquals($some, $some2);
        $this->assertNotSame($some, $some2);

        $this->assertNotEquals($obj, $obj2);
        $this->assertNotSame($obj, $obj2);

        $this->assertEquals('baz', $obj->foo);
        $this->assertEquals('bar', $obj2->foo);
    }

    public function test_none(): void
    {
        $none = new None();
        $none2 = $none->copied();

        $this->assertEquals($none, $none2);
        $this->assertNotSame($none, $none2);
    }
}
