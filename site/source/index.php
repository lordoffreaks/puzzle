<?php 

include_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

/** @var League\Container\Container $container */
$container = new League\Container\Container;

/** @var League\Route\RouteCollection $router */
$router = new League\Route\RouteCollection($container);

include_once dirname(dirname(__DIR__)) . '/includes/services.php';
include_once dirname(dirname(__DIR__)) . '/includes/routes.php';

$dispatcher = $router->getDispatcher();
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

$response->send();
