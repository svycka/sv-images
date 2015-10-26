<?php
namespace SvImages\Transformer;

use Intervention\Image;
use Intervention\Image\ImageManager;
use SvImages\Exception\InvalidArgumentException;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class Crop extends AbstractTransformer
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * {@inheritdoc}
     */
    protected $defaults = [
        'x' => 0,
        'y' => 0,
        'width' => null,
        'height' => null,
    ];

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($source, $options)
    {
        $options = $this->parseOptions($options);

        $image = $this->imageManager->make($source);

        $image->crop(
            $options['width'],
            $options['height'],
            $options['x'],
            $options['y']
        );

        return $image->encode($image->mime())->getEncoded();
    }

    /**
     * {@inheritdoc}
     */
    protected function parseOptions($options)
    {
        $options = parent::parseOptions($options);

        if (empty($options['width']) || empty($options['height'])) {
            throw new InvalidArgumentException; //todo
        }

        return $options;
    }

    /**
     * {@inheritdoc}
     */
    protected function parseOptionsString($options)
    {
        $parsed_options = [];
        $options_list = explode(',', $options, 4);

        foreach ($options_list as $option) {
            if (preg_match('/^w(?<value>[1-9]\d*)$/', $option, $match)) {
                $parsed_options['width'] = $match['value'];
            } elseif (preg_match('/^h(?<value>[1-9]\d*)$/', $option, $match)) {
                $parsed_options['height'] = $match['value'];
            }  elseif (preg_match('/^x(?<value>[1-9]\d*)$/', $option, $match)) {
                $parsed_options['x'] = $match['value'];
            }  elseif (preg_match('/^y(?<value>[1-9]\d*)$/', $option, $match)) {
                $parsed_options['y'] = $match['value'];
            }
        }

        return $parsed_options;
    }
}
