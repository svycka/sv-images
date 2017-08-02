<?php
namespace SvImages\Transformer\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Transformer\Crop;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class CropTransformerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Intervention\Image\ImageManager $manager */
        $manager = $container->get(\SvImages\ImageManager\InterventionImageManager::class);

        return new Crop($manager);
    }
}
