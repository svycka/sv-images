<?php
namespace SvImages\Transformer\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Transformer\TransformersManager;
use SvImages\Options\ModuleOptions;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class TransformersManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var ModuleOptions $options */
        $options = $container->get(ModuleOptions::class);

        return new TransformersManager($container, $options->getTransformers());
    }
}
