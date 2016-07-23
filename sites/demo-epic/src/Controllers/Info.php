<?php

namespace Puzzle\Demo\Controllers;

use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use voku\helper\AntiXSS;

class Info implements ContainerAwareInterface {

  use ContainerAwareTrait;

  public function post(Request $request, AntiXSS $xss, \Swift_Mailer $mailer, array $vars) {

    $name = $xss->xss_clean($request->request->get('name'));
    $mail = $xss->xss_clean($request->request->get('mail'));
    $message = $xss->xss_clean($request->request->get('message'));

    $return = [
      'name' => $name,
      'mail' => $mail,
      'message' => $message,
    ];

    return $return;
  }
}