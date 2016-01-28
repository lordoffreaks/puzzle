<?php

namespace Puzzle\Route\Strategy;

use League\Route\Strategy\RestfulStrategy;

class ContainerAwareRestfulStrategy extends RestfulStrategy
{
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
