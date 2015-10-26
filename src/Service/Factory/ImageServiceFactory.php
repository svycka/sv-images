<?php

namespace SvImages\Service\Factory;

use SvImages\Exception\InvalidArgumentException;
use SvImages\Filesystem\Filesystem;
use SvImages\Options\ModuleOptions;
use SvImages\Transformer\TransformersManager;
use SvImages\Service\ImageService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageServiceFactory implements FactoryInterface
{
    /**
     * Create ImageService
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ImageService
     * @throws InvalidArgumentException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $options */
        $options = $serviceLocator->get(ModuleOptions::class);

        if (!$serviceLocator->has($options->getSource())) {
            throw new InvalidArgumentException('Images source filesystem is not set.');
        }

        /** @var Filesystem $filesystem */
        $filesystem = $serviceLocator->get($options->getSource());
        /** @var TransformersManager $transformersManager */
        $transformersManager = $serviceLocator->get(TransformersManager::class);

        return new ImageService($filesystem, $transformersManager);
    }
}