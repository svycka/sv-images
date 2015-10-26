<?php

namespace SvImages\ImageManager;

use Intervention\Image\ImageManager;
use SvImages\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class InterventionImageManager implements FactoryInterface
{
    /**
     * Create ImageManager
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ImageManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $options */
        $options = $serviceLocator->get(ModuleOptions::class);

        return new ImageManager([
            'driver' => $options->getDriver()
        ]);
    }
}