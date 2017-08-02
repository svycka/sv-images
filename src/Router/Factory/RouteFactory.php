<?php
namespace SvImages\Router\Factory;

use Interop\Container\ContainerInterface;
use SvImages\Router\ImageRoute;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class RouteFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ImageRoute($options);
    }
}
