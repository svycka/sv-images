<?php

namespace SvImages\Filesystem;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
interface FilesystemAdapterInterface
{
    /**
     * Read a file.
     *
     * @param string $path The path to the file.
     *
     * @return string|false The file contents or false on failure.
     */
    public function read($path);

    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return bool
     */
    public function has($path);

    /**
     * Create a file or update if exists.
     *
     * @param string $path     The path to the file.
     * @param string $contents The file contents.
     *
     * @return bool True on success, false on failure.
     */
    public function put($path, $contents);

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @return bool True on success, false on failure.
     */
    public function delete($path);
}
