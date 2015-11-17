<?php

namespace SvImagesTest\Router;

use SvImages\Exception\RuntimeException;
use SvImages\Exception\TransformerNotFoundException;
use SvImages\Exception\UnexpectedValueException;
use SvImages\Router\ImageRoute;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageRouteTest extends \PHPUnit_Framework_TestCase
{
    /** @var ImageRoute */
    private $route;

    public function setUp()
    {
        $routeOptions = [
            'container'    => 'image',
            'transformers' => [
                [
                    'name'     => 'fit',
                    'type'     => \SvImages\Transformer\Fit::class,
                    'defaults' => [
                        'width'    => 200,
                        'position' => 'top'
                    ],
                ],
            ],
        ];
        $this->route = new ImageRoute($routeOptions);
    }

    public function testCanAssembleParams()
    {
        $assembledUri = $this->route->assemble([
            'key' => 'my_image.jpg',
            'transformers' => 'fit,w250,h180',
        ]);
        $this->assertEquals('/image/fit,w250,h180/f_key/my_image.jpg', $assembledUri);
    }

    /**
     * @dataProvider invalidAssembleParamsData
     *
     * @param array $params
     */
    public function testAssembleWillThrowExceptionWithInvalidParams($params, $exception, $exceptionMessage)
    {
        $this->setExpectedException($exception, $exceptionMessage);

        $this->route->assemble($params);
    }

    public function invalidAssembleParamsData()
    {
        return [
            [
                ['key' => 'my_image.jpg', 'transformers' => 'unknown,w250,h180'],
                TransformerNotFoundException::class,
                "Transformer 'unknown' does not exist in 'image' container.",
            ],
            [
                ['key' => 'my_image.jpg'],
                UnexpectedValueException::class,
                'Route params requires "transformers" parameter',
            ],
            [
                ['transformers' => 'fit,w250,h180'],
                UnexpectedValueException::class,
                'Route params requires "key" parameter',
            ],
            [
                ['key' => 'my_image.jpg', 'transformers' => 'fit:w250,h180'],
                RuntimeException::class,
                'Generated URI "/image/fit:w250,h180/f_key/my_image.jpg" is invalid. ' .
                'Please verify that all parameters are correct.',
            ],
        ];
    }
}
