<?php
namespace SvImages\Router\Factory;

use SvImages\Router\ImageRoute;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class RouteFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    /**
     * Options to use when creating an instance
     *
     * @var array
     */
    protected $creationOptions = [];

    public function createService(ServiceLocatorInterface $serviceLocator, $cName = null, $rName = null)
    {
        return new ImageRoute($this->creationOptions);
    }

    /**
     * Set creation options
     *
     * @param  array $options
     *
     * @return void
     */
    public function setCreationOptions(array $options)
    {
        $this->creationOptions = $options;
    }
}
