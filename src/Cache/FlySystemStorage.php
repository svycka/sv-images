<?php

namespace SvImages\Cache;

use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class FlySystemStorage implements StorageInterface
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Returns the value for a key.
     *
     * @param string $key A unique key
     *
     * @return string|false The file contents or false on failure.
     */
    public function get($key)
    {
        try {
            return $this->filesystem->read($key);
        } catch (FileNotFoundException $exception) {
            return false;
        }
    }

    /**
     * Checks if the cache has a value for a key.
     *
     * @param string $key A unique key
     *
     * @return Boolean Whether the cache has a value for this key
     */
    public function has($key)
    {
        return $this->filesystem->has($key);
    }

    /**
     * Sets a value in the cache.
     *
     * @param string $key      A unique key
     * @param string $contents The value to cache
     *
     * @return bool True on success, false on failure.
     */
    public function set($key, $contents)
    {
        $this->filesystem->put($key, $contents);
    }

    /**
     * Removes a value from the cache.
     *
     * @param string $key A unique key
     *
     * @return bool True on success, false on failure.
     */
    public function remove($key)
    {
        try {
            return $this->filesystem->delete($key);
        } catch (FileNotFoundException $exception) {
            return false;
        }
    }
}