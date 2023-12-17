<?php

declare(strict_types=1);

namespace Tests;

use Lord\Option\None;
use Lord\Option\Some;
use PHPUnit\Framework\TestCase;
use stdClass;

class ClonedTest extends TestCase
{
    public function test_some(): void
    {
        $obj = new stdClass();
        $obj->foo = 'bar';

        $some = new Some($obj);

        $some2 = $some->cloned();
        $obj2 = $some2->unwrap();

        $obj->foo = 'baz';

        $this->assertEquals($some, $some2);
        $this->assertNotSame($some, $some2);

        $this->assertEquals($obj, $obj2);
        $this->assertSame($obj, $obj2);

        $this->assertEquals('baz', $obj->foo);
        $this->assertEquals('baz', $obj2->foo);
    }

    public function test_none(): void
    {
        $none = new None();

        $none2 = $none->cloned();

        $this->assertEquals($none, $none2);
        $this->assertNotSame($none, $none2);
    }
}
