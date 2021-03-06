<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.01.17
 * Time: 12:26
 */

namespace rollun\example\actionrender\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class HelloAction implements MiddlewareInterface
{

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param Request $request
     * @param DelegateInterface $delegate
     * @return Response
     * @throws \Exception
     */
    public function process(Request $request, DelegateInterface $delegate)
    {
        $name = $request->getAttribute('name');
        $str = "[" . constant('APP_ENV') . "] Hello $name!";

        if ($name === "error") {
            throw new \Exception("Exception by string: $str");
        }
        $request = $request->withAttribute('responseData', ['str' => $str]);
        $response = $delegate->process($request);
        return $response;
    }
}
