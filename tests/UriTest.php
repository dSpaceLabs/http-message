<?php

namespace Dspacelabs\Component\Http\Message\Tests;

use PHPUnit\Framework\TestCase;
use Dspacelabs\Component\Http\Message\Uri;

class UriTest extends TestCase
{
    public function testCreate()
    {
        $uri = (new Uri())
            ->withScheme('http')
            ->withHost('www.example.com');

        $this->assertSame('http', $uri->getScheme());
        $this->assertSame('', $uri->getAuthority());
        $this->assertSame('', $uri->getUserInfo());
        $this->assertSame('www.example.com', $uri->getHost());
        $this->assertSame(null, $uri->getPort());
        $this->assertSame('', $uri->getPath());
        $this->assertSame('', $uri->getQuery());
        $this->assertSame('', $uri->getFragment());
    }

    public function testWithScheme()
    {
        $uri = (new Uri())->withScheme('http');
        $this->assertSame('http', $uri->getScheme());
        $this->assertSame('', $uri->getAuthority());
        $this->assertSame('', $uri->getUserInfo());
        $this->assertSame('', $uri->getHost());
        $this->assertSame(null, $uri->getPort());
        $this->assertSame('', $uri->getPath());
        $this->assertSame('', $uri->getQuery());
        $this->assertSame('', $uri->getFragment());
    }

    public function testWithUserInfo()
    {
        $uri = (new Uri())->withUserInfo('username');
        $this->assertSame('', $uri->getScheme());
        $this->assertSame('', $uri->getAuthority());
        $this->assertSame('username', $uri->getUserInfo());
        $this->assertSame('', $uri->getHost());
        $this->assertSame(null, $uri->getPort());
        $this->assertSame('', $uri->getPath());
        $this->assertSame('', $uri->getQuery());
        $this->assertSame('', $uri->getFragment());

        $uri = (new Uri())->withUserInfo('username', 'password');
        $this->assertSame('', $uri->getScheme());
        $this->assertSame('', $uri->getAuthority());
        $this->assertSame('username:password', $uri->getUserInfo());
        $this->assertSame('', $uri->getHost());
        $this->assertSame(null, $uri->getPort());
        $this->assertSame('', $uri->getPath());
        $this->assertSame('', $uri->getQuery());
        $this->assertSame('', $uri->getFragment());
    }

    public function testToString()
    {
        $uri = (new Uri())
            ->withScheme('http')
            ->withUserInfo('username', 'password')
            ->withHost('www.example.com')
            ->withPort(80)
            ->withPath('/')
            ->withQuery('page=1')
            ->withFragment('heading');
        $this->assertSame('http://username:password@www.example.com:80/?page=1#heading', $uri->__toString());
    }
}
