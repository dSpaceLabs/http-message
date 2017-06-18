<?php

namespace Dspacelabs\Component\Http\Message\Tests;

use PHPUnit\Framework\TestCase;
use Dspacelabs\Component\Http\Message\Message;

class MessageTest extends TestCase
{
    public function testHeaderCaseInsensitive()
    {
        $msg = (new Message())->withHeader('foo', 'bar');
        $this->assertSame('bar', $msg->getHeaderLine('foo'));
        $this->assertSame('bar', $msg->getHeaderLine('FOO'));

        $msg = $msg->withHeader('foo', 'baz');
        $this->assertSame('baz', $msg->getHeaderLine('foo'));
    }

    public function testHeaderMultipleValues()
    {
        $msg = (new Message())
            ->withHeader('foo', 'bar')
            ->withAddedHeader('foo', 'baz');

        $this->assertSame('bar, baz', $msg->getHeaderLine('foo'));
        $this->assertEquals(array('bar', 'baz'), $msg->getHeader('foo'));
    }
}
