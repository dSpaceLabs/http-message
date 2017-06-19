<?php

namespace Dspacelabs\Component\Http\Message;

use Psr\Http\Message\UriInterface;

/**
 */
class Uri implements UriInterface
{
    /**
     * @var string
     */
    protected $scheme = '';

    /**
     * @var string
     */
    protected $authority = '';

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $host = '';

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $query = '';

    /**
     * @var string
     */
    protected $fragment = '';

    /**
     * Passing in the URI as the argument will parse out the URI into it's
     * parts
     *
     * @param string|null $uri
     * @throws \InvalidArgumentException
     */
    public function __construct($uri = '')
    {
        if ('' != $uri) {
            $parts = parse_url($uri);
            $this->parseParts($parts);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthority()
    {
        if ('' == $this->host) {
            return '';
        }

        $authority = '';
        if ($this->username || $this->password) {
            $authority .= $this->getUserInfo().'@';
        }

        $authority .= $this->host;

        if (null != $this->port) {
            $authority .= ':'.$this->port;
        }

        return $authority;
    }

    /**
     * {@inheritDoc}
     */
    public function getUserInfo()
    {
        if (!$this->password) {
            return $this->username;
        }

        return $this->username.':'.$this->password;
    }

    /**
     * {@inheritDoc}
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * {@inheritDoc}
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritDoc}
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * {@inheritDoc}
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * {@inheritDoc}
     */
    public function withScheme($scheme)
    {
        if ($scheme === $this->scheme) {
            return $this;
        }

        $uri         = clone $this;
        $uri->scheme = $scheme;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withUserInfo($user, $password = null)
    {
        if ($user === $this->username && $password === $this->password) {
            return $this;
        }

        $uri           = clone $this;
        $uri->username = $user;
        $uri->password = $password;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withHost($host)
    {
        if ($host === $this->host) {
            return $this;
        }

        $uri       = clone $this;
        $uri->host = $host;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withPort($port)
    {
        if ($port === $this->port) {
            return $this;
        }

        $uri       = clone $this;
        $uri->port = $port;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withPath($path)
    {
        if ($path === $this->path) {
            return $this;
        }

        $uri       = clone $this;
        $uri->path = $path;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withQuery($query)
    {
        if ($query === $this->query) {
            return $this;
        }

        $uri        = clone $this;
        $uri->query = $query;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function withFragment($fragment)
    {
        if ($fragment === $this->fragment) {
            return $this;
        }

        $uri           = clone $this;
        $uri->fragment = $fragment;

        return $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        $uri = '';
        if ('' != $this->scheme) {
            $uri .= $this->scheme.':';
        }

        $uri .= '//'.$this->getAuthority();

        $uri .= $this->path;

        if ('' != $this->query) {
            $uri .= '?'.$this->query;
        }

        if ('' != $this->fragment) {
            $uri .= '#'.$this->fragment;
        }

        return $uri;
    }

    /**
     * @see http://php.net/manual/en/function.parse-url.php
     * @param array $parts
     * @return void
     */
    protected function parseParts(array $parts)
    {
        $this->scheme   = isset($parts['scheme']) ? $parts['scheme'] : '';
        $this->host     = isset($parts['host']) ? $parts['host'] : '';
        $this->port     = isset($parts['port']) ? $parts['port'] : null;
        $this->username = isset($parts['user']) ? $parts['user'] : '';
        $this->password = isset($parts['pass']) ? $parts['pass'] : '';
        $this->path     = isset($parts['path']) ? $parts['path'] : '';
        $this->query    = isset($parts['query']) ? $parts['query'] : '';
        $this->fragment = isset($parts['fragment']) ? $parts['fragment'] : '';
    }
}
