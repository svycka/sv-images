<?php

namespace SvImages\Service\Factory;

use SvImages\Cache\FlySystemStorage;
use SvImages\Cache\StorageInterface;
use SvImages\Exception\InvalidArgumentException;
use SvImages\Options\ModuleOptions;
use SvImages\Service\CacheManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class CacheManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return CacheManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $options */
        $options = $serviceLocator->get(ModuleOptions::class);

        if (!$serviceLocator->has($options->getCache())) {
            throw new InvalidArgumentException('Images cache storage is not set.');
        }

        /** @var StorageInterface $storage */
        $storage = $serviceLocator->get($options->getCache());

        return new CacheManager($storage);
    }
}
