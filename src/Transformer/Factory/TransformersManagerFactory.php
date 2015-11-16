<?php
namespace SvImages\Transformer\Factory;

use SvImages\Transformer\FiltersManager;
use SvImages\Transformer\TransformersManager;
use SvImages\Options\ModuleOptions;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class TransformersManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $options */
        $options = $serviceLocator->get(ModuleOptions::class);
        $serviceConfig = new Config($options->getTransformers());

        return new TransformersManager($serviceConfig);
    }
}
