<?php

namespace SvImages\ImageManager;

use Intervention\Image\ImageManager;
use Psr\Container\ContainerInterface;
use SvImages\Options\ModuleOptions;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class InterventionImageManager
{
    /**
     * Create ImageManager
     *
     * @param ContainerInterface $container
     *
     * @return ImageManager
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);

        return new ImageManager([
            'driver' => $options->getDriver()
        ]);
    }
}
