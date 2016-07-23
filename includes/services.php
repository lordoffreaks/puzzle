<?php

// Mailer service.
$container->add('mailer', function() {

  $server   = getenv('MAILGUN_SMTP_SERVER');
  $port     = getenv('MAILGUN_SMTP_PORT');
  $username = getenv('MAILGUN_SMTP_LOGIN');
  $password = getenv('MAILGUN_SMTP_PASSWORD');

  // Create the Transport
  $transport = \Swift_SmtpTransport::newInstance($server, $port)
    ->setUsername($username)
    ->setPassword($password)
  ;

  // Create the Mailer using your created Transport
  $mailer = \Swift_Mailer::newInstance($transport);

  return $mailer;
});

// Xss service.
$container->add('xss', function() {
  return new voku\helper\AntiXSS();
});
