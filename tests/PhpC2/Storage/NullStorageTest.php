<?php

namespace App\Tests\PhpC2\Storage;

use App\PhpC2\Storage\NullStorage;
use PHPUnit\Framework\TestCase;

class NullStorageTest extends TestCase
{
    protected static ?NullStorage $storage = null;

    public static function setUpBeforeClass(): void
    {
        static::$storage = new NullStorage();
    }

    public function testNullStorageIsEmptyWhenCreated(): void
    {
        $this->assertEmpty(static::$storage->toArray());
    }

    public function testGetReturnsEmptyString()
    {
        $actual = static::$storage->get('foo');

        $this->assertSame('', $actual);
    }

    public function testSetInsertsLineInSession()
    {
        $actual = static::$storage->set('bar', 'baz');

        $this->assertTrue($actual);
        
        $inserted = static::$storage->toArray();
        $this->assertSame('baz', $inserted['bar']);
    }
}
