<?php

namespace SvImages\Transformer;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * Class TransformersManager
 *
 * TransformersManager implementation for managing image transformers
 *
 * @method \SvImages\Transformer\TransformerInterface get($name)
 *
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class TransformersManager extends AbstractPluginManager
{
    /** {@inheritDoc} */
    protected $sharedByDefault = false;

    /** {@inheritDoc} */
    protected $instanceOf = TransformerInterface::class;
}
