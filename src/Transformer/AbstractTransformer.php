<?php
namespace SvImages\Transformer;

use Intervention\Image;
use SvImages\Exception\InvalidArgumentException;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
abstract class AbstractTransformer implements TransformerInterface
{
    /**
     * Default transformer options
     *
     * @var array
     */
    protected $defaults = [];

    /**
     * {@inheritdoc}
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = array_merge($this->defaults, $defaults);
    }

    /**
     * Parse and validates options
     *
     * @param string|array $options
     *
     * @return array
     * @throws InvalidArgumentException
     */
    protected function parseOptions($options)
    {
        $parsed_options = [];

        if (!empty($options)) {
            if (is_string($options)) {
                $parsed_options = $this->parseOptionsString($options);
            } elseif (is_array($options)) {
                $parsed_options = $options;
            } else {
                throw new InvalidArgumentException(sprintf(
                    'Expected string or array as parameters but got %s',
                    (is_object($options) ? get_class($options) : gettype($options))
                ));
            }
        }

        return array_merge($this->defaults, $parsed_options);
    }

    /**
     * Parse and validates options from string
     *
     * @param $options
     *
     * @return array
     */
    abstract protected function parseOptionsString($options);
}
