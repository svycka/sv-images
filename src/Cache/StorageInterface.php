<?php

namespace SvImages\Cache;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
interface StorageInterface
{
    /**
     * Returns the value for a key.
     *
     * @param string $key A unique key
     *
     * @return string|false The file contents or false on failure.
     */
    public function get($key);

    /**
     * Checks if the cache has a value for a key.
     *
     * @param string $key A unique key
     *
     * @return Boolean Whether the cache has a value for this key
     */
    public function has($key);

    /**
     * Sets a value in the cache.
     *
     * @param string $key      A unique key
     * @param string $contents The value to cache
     *
     * @return bool True on success, false on failure.
     */
    public function set($key, $contents);

    /**
     * Removes a value from the cache.
     *
     * @param string $key A unique key
     *
     * @return bool True on success, false on failure.
     */
    public function remove($key);
}