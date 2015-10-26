<?php
namespace SvImages\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ModuleOptions extends AbstractOptions
{
    /**
     * Filesystem registered in service manager
     *
     * @var string
     */
    protected $source = '';

    /**
     * Cache service name registered in service manager
     * should implement StorageInterface
     *
     * @var string
     */
    protected $cache = '';

    /**
     * Image driver name ex.: gd, imagic
     *
     * @var string
     */
    protected $driver = 'gd';

    /**
     * Cache enabled status
     *
     * @var bool
     */
    protected $cache_enabled = false;

    /**
     * Config for transformers manager
     * this allows adding custom transformers
     *
     * @var array
     */
    protected $transformers = [];

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return string
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param string $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return boolean
     */
    public function isCacheEnabled()
    {
        return $this->cache_enabled;
    }

    /**
     * @param boolean $cache_enabled
     */
    public function setCacheEnabled($cache_enabled)
    {
        $this->cache_enabled = $cache_enabled;
    }

    /**
     * @return array
     */
    public function getTransformers()
    {
        return $this->transformers;
    }

    /**
     * @param array $transformers
     */
    public function setTransformers($transformers)
    {
        $this->transformers = $transformers;
    }

}
