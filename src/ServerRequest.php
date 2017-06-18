<?php

namespace Dspacelabs\Component\Http;

/**
 */
class ServerRequest implements ServerRequestInterface
{
    /**
     * {@inheritDoc}
     */
    public function getServerParams()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getCookieParams()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function withCookieParams(array $cookies)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getQueryParams()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function withQueryParams(array $query)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadedFiles()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getParsedBody()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function withParsedBody($data)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getAttribute($name, $default = null)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function withAttribute($name, $value)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function withoutAttribute($name)
    {
    }
}
