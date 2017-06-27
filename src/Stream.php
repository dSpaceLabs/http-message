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
     * @var array
     */
    protected $metadata = array();

    protected $modeMapping = array(
        'readable' => array('r', 'r+', 'w+', 'a+', 'x+', 'c+', 'rb', 'w+b'),
        'writable' => array('r+', 'w', 'a', 'x', 'c', 'w+b'),
    );

    protected $seekable;
    protected $readable;
    protected $writable;

    /**
     * @param resource $stream
     */
    public function __construct($stream)
    {
        if (!is_resource($stream)) {
            throw new \InvalidArgumentException('Invalid Resource');
        }

        $this->stream   = $stream;
        $this->metadata = stream_get_meta_data($this->stream);
        $this->seekable = $this->metadata['seekable'];
        $this->readable = in_array($this->metadata['mode'], $this->modeMapping['readable']);
        $this->writable = in_array($this->metadata['mode'], $this->modeMapping['writable']);
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
        if (!$this->stream) {
            return 0;
        }

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
        return $this->seekable;
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
        return $this->writable;
    }

    /**
     * {@inheritDoc}
     */
    public function write($string)
    {
        $bytes = fwrite($this->stream, $string);

        if (false === $bytes) {
            throw new \RuntimeException('Unable to write to stream');
        }

        return $bytes;
    }

    /**
     * {@inheritDoc}
     */
    public function isReadable()
    {
        return $this->readable;
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
        $contents = stream_get_contents($this->stream);

        if (false === $contents) {
            throw new \RuntimeException('Unable to get contents of stream');
        }

        return $contents;
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
