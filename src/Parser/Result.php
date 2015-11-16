<?php

namespace SvImages\Parser;

use SvImages\Transformer\TransformerInterface;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class Result
{
    /**
     * @var string
     */
    protected $container;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $uriPath;

    /**
     * @var TransformerInterface[]
     */
    protected $transformers = [];

    /**
     * @var array
     */
    protected $routeOptions = [];

    /**
     * @return string
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param string $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return TransformerInterface[]
     */
    public function getTransformers()
    {
        return $this->transformers;
    }

    /**
     * @param TransformerInterface[] $transformers
     */
    public function setTransformers(array $transformers)
    {
        $this->transformers = $transformers;
    }

    /**
     * @return string
     */
    public function getUriPath()
    {
        return $this->uriPath;
    }

    /**
     * @param string $uriPath
     */
    public function setUriPath($uriPath)
    {
        $this->uriPath = $uriPath;
    }

    /**
     * @return array
     */
    public function getRouteOptions()
    {
        return $this->routeOptions;
    }

    /**
     * @param array $routeOptions
     */
    public function setRouteOptions(array $routeOptions)
    {
        $this->routeOptions = $routeOptions;
    }
}
