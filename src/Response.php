<?php

namespace Dspacelabs\Component\Http;

/**
 */
class Response extends Message
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
    }

    /**
     * {@inheritDoc}
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }
}
