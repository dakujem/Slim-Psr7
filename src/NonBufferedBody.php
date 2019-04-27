<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim-Psr7/blob/master/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Psr7;

use Psr\Http\Message\StreamInterface;

/**
 * Represents a non-readable stream that whenever it is written pushes
 * the data back to the browser immediately.
 *
 * @link https://github.com/php-fig/http-message/blob/master/src/StreamInterface.php
 */
class NonBufferedBody implements StreamInterface
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function detach()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function tell()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function eof()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isSeekable()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function seek($offset, $whence = SEEK_SET)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function isWritable()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function write($string)
    {
        $buffered = '';
        while (0 < \ob_get_level()) {
            $buffered = \ob_get_clean() . $buffered;
        }

        echo $buffered . $string;

        \flush();

        return \strlen($string) + \strlen($buffered);
    }

    /**
     * {@inheritdoc}
     */
    public function isReadable()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function read($length)
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getContents()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadata($key = null)
    {
        return null;
    }
}
