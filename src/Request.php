<?php

namespace Dspacelabs\Component\Http\Message;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;

/**
 */
class Request extends Message implements RequestInterface
{
    /**
     * @var string
     */
    protected $requestTarget = '';

    /**
     * @var string
     */
    protected $method = '';

    /**
     * @var UriInterface
     */
    protected $uri;

    /**
     * {@inheritDoc}
     */
    public function getRequestTarget()
    {
        return $this->requestTarget;
    }

    /**
     * {@inheritDoc}
     */
    public function withRequestTarget($requestTarget)
    {
        $request = clone $this;
        $request->requestTarget = $requestTarget;

        return $request;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * {@inheritDoc}
     */
    public function withMethod($method)
    {
        $request = clone $this;
        $request->method = $method;

        return $request;
    }

    /**
     * {@inheritDoc}
     */
    public function getUri()
    {
        if (null === $this->uri) {
            $this->uri = new Uri();
        }

        return $this->uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        $request = clone $this;
        $request->uri = $uri;

        return $request;
    }
}
