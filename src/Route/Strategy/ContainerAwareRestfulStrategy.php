<?php

namespace Puzzle\Route\Strategy;

use League\Route\Strategy\RestfulStrategy;
use ArrayObject;
use League\Route\Http\Exception as HttpException;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContainerAwareRestfulStrategy extends RestfulStrategy
{

    /**
     * {@inheritdoc}
     */
    public function dispatch($controller, array $vars)
    {
        try {
            $response = $this->invokeController($controller, [
              $this->getRequest(),
              $vars,
              $this->getContainer()->get('config')
            ]);

            if ($response instanceof JsonResponse) {
                return $response;
            }

            if (is_array($response) || $response instanceof ArrayObject) {
                return new JsonResponse($response);
            }

            throw new RuntimeException(
              'Your controller action must return a valid response for the Restful Strategy. ' .
              'Acceptable responses are of type: [Array], [ArrayObject] and [Symfony\Component\HttpFoundation\JsonResponse]'
            );
        } catch (HttpException $e) {
            return $e->getJsonResponse();
        }
    }

    /**
     * Invoke a controller action
     *
     * @param  string|array|\Closure $controller
     * @param  array                 $vars
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function invokeController($controller, array $vars = [])
    {
        if (is_array($controller)) {
            $controller = [
              (is_object($controller[0])) ? $controller[0] : $this->getContainer()->get($controller[0]),
              $controller[1]
            ];
        }

        $controller[0]->setContainer($this->getContainer());

        return call_user_func_array($controller, array_values($vars));
    }
}
