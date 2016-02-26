<?php

use Puzzle\Demo\Strategy\RestfulStrategy;

$router->post('/info', 'Puzzle\Demo\Controllers\Info::post', new RestfulStrategy());
