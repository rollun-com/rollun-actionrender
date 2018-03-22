<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.03.17
 * Time: 12:55
 */

namespace rollun\actionrender\MiddlewareDeterminator;

use Psr\Http\Message\ServerRequestInterface as Request;
use rollun\actionrender\MiddlewareDeterminator\Interfaces\MiddlewareDeterminatorInterface;

class ResponseRenderer implements MiddlewareDeterminatorInterface
{
    /**
     * [
     *  $key //-> pattern
     *      => $value, //-> middlewareServiceName
     * ]
     * @var array
     */
    protected $middlewares;

    /**
     * ResponseRenderer constructor.
     * @param string[] $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getMiddlewareServiceName(Request $request)
    {
        $accept = $request->getHeaderLine('Accept');

        foreach ($this->middlewares as $acceptTypePattern => $middlewareService) {
            if (preg_match($acceptTypePattern, $accept)) {
                return $middlewareService;
            }
        }
        throw new MiddlewareDeterminatorException("Middleware service name not determinate.");
    }
}
