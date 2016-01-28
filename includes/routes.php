<?php

use Puzzle\Route\Strategy\ContainerAwareRestfulStrategy;

$router->post('/info', 'Puzzle\Demo\Controllers\Info::post', new ContainerAwareRestfulStrategy());
