<?php

namespace Dspacelabs\Component\Http\Message;

use Psr\Http\Message\ResponseInterface;

/**
 */
class Response extends Message implements ResponseInterface
{
    /**
     * @var integer
     */
    protected $code;

    /**
     * @var string
     */
    protected $reasonPhrase = '';

    /**
     * {@inheritDoc}
     */
    public function getStatusCode()
    {
        return $this->code;
    }

    /**
     * {@inheritDoc}
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $response = clone $this;
        $response->code = $code;
        $response->reasonPhrase = $reasonPhrase;

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }
}
