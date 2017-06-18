<?php

namespace Dspacelabs\Component\Http\Tests;

use PHPUnit\Framework\TestCase;
use Dspacelabs\Component\Http\Request;
use Dspacelabs\Component\Http\Uri;

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
