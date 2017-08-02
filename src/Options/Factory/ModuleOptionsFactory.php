<?php
namespace SvImages\Options\Factory;

use Psr\Container\ContainerInterface;
use SvImages\Options\ModuleOptions;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ModuleOptionsFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ModuleOptions($container->get('Config')['sv_images']);
    }
}
