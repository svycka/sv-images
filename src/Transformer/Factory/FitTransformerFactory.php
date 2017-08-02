<?php
namespace SvImages\Transformer\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Transformer\Fit;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class FitTransformerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var \Intervention\Image\ImageManager $manager */
        $manager = $container->get('SvImages\ImageManager\InterventionImageManager');

        return new Fit($manager);
    }
}
