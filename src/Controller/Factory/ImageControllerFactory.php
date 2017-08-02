<?php

namespace SvImages\Controller\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Controller\ImageController;
use SvImages\Options\ModuleOptions;
use SvImages\Service\CacheManager;
use SvImages\Service\ImageService;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageControllerFactory
{
    /**
     * Create ImageController
     *
     * @param ContainerInterface $container
     *
     * @return ImageController
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var ImageService $imageService */
        $imageService = $container->get(ImageService::class);
        /** @var CacheManager $cacheManager */
        $cacheManager = $container->get(CacheManager::class);
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);

        return new ImageController($imageService, $cacheManager, $options);
    }
}
