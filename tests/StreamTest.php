<?php

namespace Dspacelabs\Component\Http\Message\Tests;

use PHPUnit\Framework\TestCase;
use Dspacelabs\Component\Http\Message\Stream;

class StreamTest extends TestCase
{
    public function testGeneric()
    {
        $stream = new Stream(fopen('php://temp', 'r'));
        $this->assertSame(0, $stream->getSize());
        $this->assertSame(0, $stream->tell());
        $this->assertFalse($stream->eof());
        $this->assertSame('', $stream->getContents());

        $this->assertTrue($stream->isSeekable());
        $this->assertFalse($stream->isWritable());
        $this->assertTrue($stream->isReadable());

        $this->assertInternalType('array', $stream->getMetadata());
    }

    public function testWrite()
    {
        $stream = new Stream(fopen('php://temp', 'r+'));
        $this->assertTrue($stream->isSeekable());
        $this->assertTrue($stream->isWritable());
        $this->assertTrue($stream->isReadable());

        $bytes = $stream->write('hello');
        $this->assertSame(5, $bytes);
        $this->assertSame(5, $stream->getSize());
        $stream->rewind();
        $this->assertSame('hello', $stream->getContents());
    }
}
