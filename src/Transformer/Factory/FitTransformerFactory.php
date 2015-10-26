<?php
namespace SvImages\Transformer\Factory;

use SvImages\Transformer\Fit;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class FitTransformerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        /** @var \Intervention\Image\ImageManager $manager */
        $manager = $sm->get('SvImages\ImageManager\InterventionImageManager');

        return new Fit($manager);
    }
}