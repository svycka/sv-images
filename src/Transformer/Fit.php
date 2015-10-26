<?php
namespace SvImages\Transformer;

use Intervention\Image;
use Intervention\Image\ImageManager;
use SvImages\Exception\InvalidArgumentException;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class Fit extends AbstractTransformer
{
    const POSITIONS = [
        'top-left',
        'top',
        'top-right',
        'left',
        'center',
        'right',
        'bottom-left',
        'bottom',
        'bottom-right',
        'tl',
        't',
        'tr',
        'l',
        'c',
        'r',
        'bl',
        'b',
        'br'
    ];

    protected $defaults = [
        'position' => 'center',
        'width' => null,
        'height' => null,
    ];

    /**
     * @var ImageManager
     */
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function apply($source, $options)
    {
        $options = $this->parseOptions($options);

        $image = $this->imageManager->make($source);

        $image->fit(
            $options['width'],
            $options['height'],
            function ($constraint) {
                $constraint->upsize();
            },
            $options['position']
        );

        return $image->encode($image->mime())->getEncoded();
    }

    /**
     * {@inheritdoc}
     */
    protected function parseOptions($options)
    {
        $options = parent::parseOptions($options);

        if (empty($options['width']) && empty($options['height'])) {
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
        $options_list = explode(',', $options, 3);

        foreach ($options_list as $option) {
            if (preg_match('/^w(?<value>[1-9]\d*)$/', $option, $match)) {
                $parsed_options['width'] = $match['value'];
            } elseif (preg_match('/^h(?<value>[1-9]\d*)$/', $option, $match)) {
                $parsed_options['height'] = $match['value'];
            } elseif (in_array($option, self::POSITIONS)) {
                switch ($option) {
                    case 'top-left':
                    case 'tl':
                        $parsed_options['position'] = 'top-left';
                        break;
                    case 'top':
                    case 't':
                        $parsed_options['position'] = 'top';
                        break;
                    case 'top-right':
                    case 'tr':
                        $parsed_options['position'] = 'top-right';
                        break;
                    case 'left':
                    case 'l':
                        $parsed_options['position'] = 'left';
                        break;
                    case 'center':
                    case 'c':
                        $parsed_options['position'] = 'center';
                        break;
                    case 'right':
                    case 'r':
                        $parsed_options['position'] = 'right';
                        break;
                    case 'bottom-left':
                    case 'bl':
                        $parsed_options['position'] = 'bottom-left';
                        break;
                    case 'bottom':
                    case 'b':
                        $parsed_options['position'] = 'bottom';
                        break;
                    case 'bottom-right':
                    case 'br':
                        $parsed_options['position'] = 'bottom-right';
                        break;
                }
            }
        }

        return $parsed_options;
    }
}
