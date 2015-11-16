<?php

namespace SvImages\Controller\Factory;

use SvImages\Controller\ImageController;
use SvImages\Options\ModuleOptions;
use SvImages\Service\CacheManager;
use SvImages\Service\ImageService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageControllerFactory implements FactoryInterface
{
    /**
     * Create ImageController
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        /** @var ImageService $imageService */
        $imageService = $sm->get(ImageService::class);
        /** @var CacheManager $cacheManager */
        $cacheManager = $sm->get(CacheManager::class);
        /** @var ModuleOptions $options */
        $options = $sm->get(ModuleOptions::class);

        return new ImageController($imageService, $cacheManager, $options);
    }
}
