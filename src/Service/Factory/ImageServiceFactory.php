<?php

namespace SvImages\Service\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Exception\InvalidArgumentException;
use SvImages\Filesystem\Filesystem;
use SvImages\Options\ModuleOptions;
use SvImages\Transformer\TransformersManager;
use SvImages\Service\ImageService;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageServiceFactory
{
    /**
     * Create ImageService
     *
     * @param ContainerInterface $container
     *
     * @return ImageService
     * @throws InvalidArgumentException
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);

        if (!$container->has($options->getSource())) {
            throw new InvalidArgumentException('Images source filesystem is not set.');
        }

        /** @var Filesystem $filesystem */
        $filesystem = $container->get($options->getSource());
        /** @var TransformersManager $transformersManager */
        $transformersManager = $container->get(TransformersManager::class);

        return new ImageService($filesystem, $transformersManager);
    }
}
