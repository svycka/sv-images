<?php

namespace SvImages\Transformer;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

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
    protected $shareByDefault = false;

    /**
     * Validate the plugin
     *
     * Checks that the transformer loaded is instance of TransformerInterface.
     *
     * @param  TransformerInterface $transformer
     *
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($transformer)
    {
        if ($transformer instanceof TransformerInterface) {
            return; // we're okay
        }

        throw new Exception\RuntimeException(sprintf(
            'Transformer of type %s is invalid; must implement %s',
            (is_object($transformer) ? get_class($transformer) : gettype($transformer)),
            TransformerInterface::class
        ));
    }
}
