<?php
namespace SvImages\Router;

use SvImages\Parser\Result;
use Zend\Mvc\Router\Http\RouteMatch as HttpRouteMatch;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class RouteMatch extends HttpRouteMatch
{
    /**
     * @var Result
     */
    protected $parserResult;

    /**
     * @param Result $result
     */
    public function setParserResult(Result $result)
    {
        $this->parserResult = $result;
    }

    /**
     * @return Result|null
     */
    public function getParserResult()
    {
        return $this->parserResult;
    }
}