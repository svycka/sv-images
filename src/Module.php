<?php

namespace SvImages;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class Module implements ConfigProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
