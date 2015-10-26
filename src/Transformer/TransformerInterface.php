<?php

namespace SvImages\Transformer;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
interface TransformerInterface
{
    /**
     * Apply transformation
     *
     * @param string $contents
     * @param mixed $options
     *
     * @return string
     */
    public function apply($contents, $options);

    /**
     * Set default transformer options
     *
     * @param array $defaults
     *
     * @return void
     */
    public function setDefaults(array $defaults);
}