<?php

namespace SvImages\Filesystem;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class Filesystem
{
    /**
     * @var FilesystemAdapterInterface
     */
    protected $adapter;

    /**
     * @param FilesystemAdapterInterface $adapter
     */
    public function __construct(FilesystemAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return bool
     */
    public function has($path)
    {
        return $this->adapter->has($path);
    }

    /**
     * Read a file.
     *
     * @param string $path The path to the file.
     *
     * @return string|false The file contents or false on failure.
     */
    public function read($path)
    {
        return $this->adapter->read($path);
    }

    /**
     * Create a file or update if exists.
     *
     * @param string $path     The path to the file.
     * @param string $contents The file contents.
     *
     * @return bool True on success, false on failure.
     */
    public function put($path, $contents)
    {
        return $this->adapter->put($path, $contents);
    }
}
