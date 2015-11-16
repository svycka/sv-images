<?php
namespace SvImages\Service;

use SvImages\Cache\StorageInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class CacheManager
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function get($key)
    {
        return $this->storage->get($key);
    }

    public function save($key, $contents)
    {
        return $this->storage->set($key, $contents);
    }

    public function has($key)
    {
        return $this->storage->has($key);
    }

    public function delete($key)
    {
        return $this->storage->remove($key);
    }
}
