<?php

namespace SvImages\Service\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Cache\StorageInterface;
use SvImages\Exception\InvalidArgumentException;
use SvImages\Options\ModuleOptions;
use SvImages\Service\CacheManager;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class CacheManagerFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     *
     * @return CacheManager
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);

        if (!$container->has($options->getCache())) {
            throw new InvalidArgumentException('Images cache storage is not set.');
        }

        /** @var StorageInterface $storage */
        $storage = $container->get($options->getCache());

        return new CacheManager($storage);
    }
}
