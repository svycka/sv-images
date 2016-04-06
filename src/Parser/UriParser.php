<?php

namespace SvImages\Parser;

use SvImages\Exception\RuntimeException;
use SvImages\Exception\TransformerNotFoundException;
use SvImages\Exception\UnexpectedValueException;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class UriParser
{
    /**
     * @var Result
     */
    protected $result;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
        $this->result  = new Result();
        $this->result->setRouteOptions($options);
    }

    /**
     * @param $path
     *
     * @return Result|null
     */
    public function parseUri($path)
    {
        $container = $this->options['container'];
        if (!preg_match(
            '/^\/'.preg_quote($container, '/').'(?:\/(?<transformers>[a-zA-Z0-9_\-,\/]+))\/f_key(?<file_path>\/.+)$/',
            $path,
            $matches
        )) {
            return null;
        }

        $result = $this->result;
        $result->setUriPath($path);
        $result->setContainer($container);
        $result->setFilePath($matches['file_path']);
        $result->setTransformers($this->parseTransformers($matches['transformers']));

        return $result;
    }

    /**
     * @param $transformersFromUri
     *
     * @return array
     *
     * @throws UnexpectedValueException
     * @throws TransformerNotFoundException
     * @throws RuntimeException
     */
    protected function parseTransformers($transformersFromUri)
    {
        $transformers_list = explode('/', $transformersFromUri);
        $transformers      = [];

        foreach ($transformers_list as $transformer) {
            if (!preg_match(
                '/^(?<name>[a-zA-Z0-9_\-]+)(?:,(?<options>[a-zA-Z0-9_\-,]+))?$/',
                $transformer,
                $matches
            )) {
                throw new UnexpectedValueException("Can't parse transformer options");
            }

            $index = array_search($matches['name'], array_column($this->options['transformers'], 'name'));
            if (false === $index) {
                throw new TransformerNotFoundException(sprintf(
                    "Transformer '%s' does not exist in '%s' container.",
                    $matches['name'],
                    $this->options['container']
                ));
            }

            $item = $this->options['transformers'][$index];

            if (!array_key_exists('type', $item)) {
                throw new RuntimeException("Transformer type is not set");
            }

            $transformer = [
                'type'    => $item['type'],
                'options' => null,
            ];

            if (array_key_exists('defaults', $item)) {
                $transformer['defaults'] = $item['defaults'];
            }

            if (array_key_exists('allow_options_override', $item)) {
                $allow_override_options = $item['allow_options_override'];
            } else {
                $allow_override_options = $this->options['allow_options_override'];
            }

            if (true === $allow_override_options && array_key_exists('options', $matches)) {
                $transformer['options'] = $matches['options'];
            }

            $transformers[] = $transformer;
        }

        return $transformers;
    }
}
