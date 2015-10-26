<?php

namespace SvImages\Filesystem\Adapter;

use League\Flysystem\FileNotFoundException;
use League\Flysystem\FilesystemInterface;
use SvImages\Filesystem\FilesystemAdapterInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class FlySystemAdapter implements FilesystemAdapterInterface
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @param FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritdoc}
     */
    public function read($path)
    {
        try {
            return $this->filesystem->read($path);
        } catch (FileNotFoundException $exception) {
            return false;
        }
    }


    /**
     * {@inheritdoc}
     */
    public function has($path)
    {
        return $this->filesystem->has($path);
    }

    /**
     * {@inheritdoc}
     */
    public function put($path, $contents)
    {
        return $this->filesystem->put($path, $contents);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($path)
    {
        try {
            return $this->filesystem->delete($path);
        } catch (FileNotFoundException $exception) {
            return false;
        }
    }
}