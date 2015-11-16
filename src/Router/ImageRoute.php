<?php

namespace SvImages\Router;

use SvImages\Exception\TransformerNotFoundException;
use SvImages\Exception\UnexpectedValueException;
use SvImages\Parser\Result;
use SvImages\Parser\UriParser;
use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ArrayUtils;
use Zend\Mvc\Router\Exception\InvalidArgumentException;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageRoute implements RouteInterface
{
    /**
     * Default route options
     *
     * @var array
     */
    protected $options = [
        'controller' => \SvImages\Controller\ImageController::class,
        'action' => 'image',
        'allow_options_override' => true,
    ];

    /**
     * Create a new page route.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if ($options instanceof \Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            throw new InvalidArgumentException(__METHOD__ . ' expects an array or Traversable set of options');
        }

        $this->options = array_merge($this->options, $options);
    }

    /**
     * Match a given request.
     *
     * @param  Request $request
     *
     * @return RouteMatch|null
     */
    public function match(Request $request)
    {
        if (!method_exists($request, 'getUri')) {
            return;
        }

        $uri  = $request->getUri();
        $path = $uri->getPath();

        try {
            $parser = new UriParser($this->options);
            $result = $parser->parseUri($path);

            if (!$result instanceof Result) {
                return;
            }
        } catch (UnexpectedValueException $exception) {
            return; // todo: think about this
        } catch (TransformerNotFoundException $exception) {
            return; // todo: think about this
        }

        $routeMatch = new RouteMatch($this->options, strlen($path));
        $routeMatch->setParserResult($result);

        return $routeMatch;
    }

    /**
     * {@inheritDoc}
     */
    public function assemble(array $params = [], array $options = [])
    {
        // TODO: Implement assemble() method.
        throw new \BadMethodCallException('Unsupported!');
    }

    /**
     * {@inheritDoc}
     */
    public function getAssembledParams()
    {
        // TODO: Implement getAssembledParams() method.
        throw new \BadMethodCallException('Unsupported!');
    }

    /**
     * @private
     * @deprecated
     */
    public static function factory($options = [])
    {
        throw new \BadMethodCallException('Unsupported!');
    }
}
