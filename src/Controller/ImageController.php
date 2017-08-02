<?php
namespace SvImages\Controller;

use SvImages\Exception\SvImagesException;
use SvImages\Options\ModuleOptions;
use SvImages\Parser\Result;
use SvImages\Router\RouteMatch;
use SvImages\Service\CacheManager;
use SvImages\Service\ImageService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Response;

/**
 * @author Vytautas Stankus <svycka@gmail.com>
 * @license MIT
 */
class ImageController extends AbstractActionController
{
    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * @var CacheManager
     */
    protected $cacheManager;

    /**
     * @var ModuleOptions
     */
    private $options;

    /**
     * @param ImageService  $imageService
     * @param CacheManager  $cacheManager
     * @param ModuleOptions $options
     */
    public function __construct(
        ImageService $imageService,
        CacheManager $cacheManager,
        ModuleOptions $options
    ) {
        $this->imageService = $imageService;
        $this->cacheManager = $cacheManager;
        $this->options = $options;
    }

    public function imageAction()
    {
        $routeMatch = $this->getEvent()->getRouteMatch();

        if (!$routeMatch instanceof RouteMatch) {
            return $this->notFoundAction(); // todo
        }

        $result = $routeMatch->getParserResult();
        $uriPath = $result->getUriPath();

        if ($this->options->isCacheEnabled() && $contents = $this->cacheManager->get($uriPath)) {
            return $this->prepareResponse($contents, $result);
        }

        // fixme: this makes debugging very difficult by hiding all exceptions
        try {
            $contents = $this->imageService->generateImage($result);
        } catch (SvImagesException $exception) {
            // TODO: maybe implement some kind of failure handling strategy?
            // error image or 1px image would be better?
            return $this->notFoundAction();
        }

        if ($this->options->isCacheEnabled() && $contents) {
            $this->cacheManager->save($uriPath, $contents);
        }

        return $this->prepareResponse($contents, $result);
    }

    /**
     * Creates response object
     *
     * @param string $content
     * @param Result $result
     *
     * @return Response
     */
    protected function prepareResponse($content, Result $result)
    {
        $mimeType = $this->guessMimeType($result->getFilePath());

        if (function_exists('mb_strlen')) {
            $contentLength = mb_strlen($content, '8bit');
        } else {
            $contentLength = strlen($content);
        }

        /* @var $response Response */
        $response = $this->getResponse();
        $response->getHeaders()
            ->addHeaderLine('Content-Transfer-Encoding', 'binary')
            ->addHeaderLine('Content-Type', $mimeType)
            ->addHeaderLine('Content-Length', $contentLength)
            // fixme: maybe add cache options to config
            ->addHeaderLine('Cache-Control', 'max-age=31536000, public')
            ->addHeaderLine('Expires', date_create('+1 years')->format('D, d M Y H:i:s').' GMT');

        $response->setContent($content);

        return $response;
    }

    /**
     * Guess MimeType by extension
     *
     * @param $filename
     *
     * @return string
     * @throws SvImagesException
     *
     * TODO: create MimeType resolver. Current implementation has a lot of problems
     */
    protected function guessMimeType($filename)
    {
        $mimeTypes = [
            'jpeg' => 'image/jpeg',
            'jpg'  => 'image/jpeg',
            'gif'  => 'image/gif',
            'png'  => 'image/png',
            'wbmp' => 'image/vnd.wap.wbmp',
            'xbm'  => 'image/xbm',
        ];

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!isset($mimeTypes[$extension])) {
            throw new SvImagesException('Invalid format');
        }

        return $mimeTypes[$extension];
    }
}
