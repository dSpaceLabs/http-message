<?php

namespace Dspacelabs\Component\Http\Message\Tests;

use PHPUnit\Framework\TestCase;
use Dspacelabs\Component\Http\Message\Request;
use Dspacelabs\Component\Http\Message\Uri;

class RequestTest extends TestCase
{
    public function testGeneric()
    {
        $request = (new Request())
            ->withMethod('OPTIONS')
            ->withRequestTarget('*')
            ->withUri(new Uri('http://www.example.com'));
        $this->assertSame('OPTIONS', $request->getMethod());
    }
}
