<?php

namespace Dspacelabs\Component\Http\Message;

use Psr\Http\Message\StreamInterface;

/**
 */
class Stream implements StreamInterface
{
    /**
     * @var resource
     */
    protected $stream;

    /**
     * @param resource $stream
     */
    public function __construct($stream)
    {
        if (!is_resource($stream)) {
            throw new \InvalidArgumentException('Invalid Resource');
        }

        $this->stream = $stream;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return stream_get_contents($this->stream);
    }

    /**
     * Make sure the stream is closed
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function detach()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getSize()
    {
        $stats = fstat($this->stream);

        return $stats['size'];
    }

    /**
     * {@inheritDoc}
     */
    public function tell()
    {
        return ftell($this->stream);
    }

    /**
     * {@inheritDoc}
     */
    public function eof()
    {
        return feof($this->stream);
    }

    /**
     * {@inheritDoc}
     */
    public function isSeekable()
    {
        $metadata = stream_get_meta_data($stream);
        return $metadata['seekable'];
    }

    /**
     * {@inheritDoc}
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        return fseek($this->stream, $offset, $whence);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->seek(0);
    }

    /**
     * {@inheritDoc}
     */
    public function isWritable()
    {
        $metadata = stream_get_meta_data($stream);
        $mode = $metadata['mode'];
    }

    /**
     * {@inheritDoc}
     */
    public function write($string)
    {
        return fwrite($this->stream, $string);
    }

    /**
     * {@inheritDoc}
     */
    public function isReadable()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function read($length)
    {
        return fread($this->stream, $length);
    }

    /**
     * {@inheritDoc}
     */
    public function getContents()
    {
        return stream_get_contents($this->stream);
    }

    /**
     * {@inheritDoc}
     */
    public function getMetadata($key = null)
    {
        $metadata = stream_get_meta_data($this->stream);

        if (null === $key) {
            return $metadata;
        }

        return isset($metadata[$key]) ? $metadata[$key] : null;
    }
}
