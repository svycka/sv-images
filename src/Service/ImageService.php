<?php

namespace SvImages\Service;

use SvImages\Filesystem\Filesystem;
use SvImages\Transformer\TransformersManager;
use SvImages\Parser\Result as ParserResult;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageService
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var TransformersManager
     */
    protected $transformersManager;

    /**
     * @param Filesystem          $fileSystem
     * @param TransformersManager $transformersManager
     */
    public function __construct(
        Filesystem $fileSystem,
        TransformersManager $transformersManager
    )
    {
        $this->filesystem          = $fileSystem;
        $this->transformersManager = $transformersManager;
    }

    /**
     * @param \SvImages\Parser\Result $parserResult
     *
     * @return false|string
     */
    public function generateImage(ParserResult $parserResult)
    {
        $path = $parserResult->getFilePath();

        $contents = $this->filesystem->read($path);
        if (false === $contents) {
            return false;
        }

        $transformers = $parserResult->getTransformers();

        foreach ($transformers as $item) {
            $transformer = $this->transformersManager->get($item['type']);
            if (!empty($item['defaults']) && is_array($item['defaults'])) {
                $transformer->setDefaults($item['defaults']);
            }
            $contents = $transformer->apply($contents, $item['options']);
        }

        return $contents;
    }
}