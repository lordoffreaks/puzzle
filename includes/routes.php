<?php

use League\Route\Strategy\RestfulStrategy;

$router->post('/info', 'Puzzle\Demo\Controllers\Info::post', new RestfulStrategy());
