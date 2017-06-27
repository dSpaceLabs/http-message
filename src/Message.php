<?php

namespace Dspacelabs\Component\Http\Message;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $version = '1.1';

    /**
     * @var array
     */
    protected $headers = array();

    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $body;

    /**
     * {@inheritDoc}
     */
    public function getProtocolVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritDoc}
     */
    public function withProtocolVersion($version)
    {
        if ($version === $this->version) {
            return $this;
        }

        $message = clone $this;
        $message->version = $version;

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * {@inheritDoc}
     */
    public function hasHeader($name)
    {
        return isset($this->headers[strtolower($name)]);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeader($name)
    {
        $name = strtolower($name);
        if (!$this->hasHeader($name)) {
            return array();
        }

        return $this->headers[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function getHeaderLine($name)
    {
        $name = strtolower($name);
        if (!$this->hasHeader($name)) {
            return '';
        }

        return implode(', ', $this->headers[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function withHeader($name, $value)
    {
        $name = strtolower($name);
        if (!is_array($value)) {
            $value = array($value);
        }

        $message = clone $this;
        $message->headers[$name] = $value;

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function withAddedHeader($name, $value)
    {
        $name = strtolower($name);

        $message = clone $this;
        $message->headers[$name][] = $value;

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function withoutHeader($name)
    {
        $name = strtolower($name);
        if (!$this->hasHeader($name)) {
            return $this;
        }

        $message = clone $this;
        unset($message->headers[$name]);

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getBody()
    {
        if (!$this->body) {
            $this->body = new Stream(fopen('php://memory', 'rw+'));
        }
        return $this->body;
    }

    /**
     * {@inheritDoc}
     */
    public function withBody(StreamInterface $body)
    {
        $message = clone $this;
        $message->body = $body;

        return $message;
    }
}
