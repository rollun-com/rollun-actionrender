<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.01.17
 * Time: 15:26
 */

namespace rollun\actionrender;

use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Stratigility\Middleware\CallableMiddlewareWrapperFactory;
use Zend\Stratigility\MiddlewarePipe;

class AbstractMiddlewarePipe extends MiddlewarePipe
{
    /**
     * MainPipe constructor.
     * @param $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->setResponsePrototype(new EmptyResponse());
        parent::__construct();
        foreach ($middlewares as $middleware) {
            $this->pipe($middleware);
        }
    }
}